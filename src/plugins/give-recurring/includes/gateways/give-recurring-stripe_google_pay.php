<?php
/**
 * Give Stripe - Google Pay Payment Method with Subscriptions.
 *
 * @since 1.9.0
 *
 * @package    Give
 * @subpackage Stripe Premium
 */

use Give\ValueObjects\Money;
use GiveRecurring\Infrastructure\Log;
use GiveRecurring\PaymentGateways\DataTransferObjects\SubscriptionDto;
use GiveRecurring\PaymentGateways\Stripe\Actions\RetrieveOrCreatePlan;
use GiveRecurring\PaymentGateways\Stripe\Actions\UpdateSubscriptionAmount;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Give_Recurring_Stripe_Google_Pay' ) ) {
	/**
	 * Class Give_Recurring_Stripe_Google_Pay
	 *
	 * @since 1.9.0
	 */
	class Give_Recurring_Stripe_Google_Pay extends Give_Recurring_Gateway {
		/**
		 * Give Invoice class for Stripe.
		 *
		 * @since 1.9.0
		 *
		 * @var Give_Stripe_Invoice
		 */
		public $invoice;

		/**
		 * Give Payment Intent class for Stripe.
		 *
		 * @since 1.9.0
		 *
		 * @var Give_Stripe_Payment_Intent
		 */
		public $payment_intent;

		/**
		 * @var Give_Stripe_Gateway
		 */
		private $stripe_gateway;

		/**
		 * Init Google Pay.
		 *
		 * @since  1.9.0
		 * @access public
		 *
		 * @return void
		 */
		public function init() {
			$this->id = 'stripe_google_pay';

			// Bailout, if Google Pay is not the active gateway.
			if ( ! give_is_gateway_active( $this->id ) ) {
				return;
			}

			$this->stripe_gateway = new Give_Stripe_Gateway();
			$this->invoice        = new Give_Stripe_Invoice();
			$this->payment_intent = new Give_Stripe_Payment_Intent();

			add_action( "give_recurring_cancel_{$this->id}_subscription", array( $this, 'cancel' ), 10, 2 );
		}

		/**
		 * Create Payment Profiles.
		 *
		 * Setup customers and plans in Stripe for the sign up.
		 *
		 * @since 1.12.6 Implement createOrRetrieveStripePlan function
		 *
		 * @return void
		 */
		public function create_payment_profiles() {

			$source = ! empty( $_POST['give_stripe_payment_method'] ) ? give_clean( $_POST['give_stripe_payment_method'] ) : $this->generate_source_dictionary();
			$email  = $this->purchase_data['user_email'];

			$source_object = $this->stripe_gateway->payment_method->retrieve( $source );

			// Add source to donation notes and meta.
			give_insert_payment_note( $this->payment_id, 'Stripe Source ID: ' . $source_object->id );
			give_update_payment_meta( $this->payment_id, '_give_stripe_source_id', $source_object->id );

			$this->stripe_customer = new Give_Stripe_Customer( $email, $source_object->id );
			$stripe_customer       = $this->stripe_customer->customer_data;
			$stripe_customer_id    = $this->stripe_customer->get_id();

			// Add donation note for customer ID.
			if ( ! empty( $stripe_customer_id ) ) {
				$source_object = $this->stripe_customer->attached_payment_method;

				give_insert_payment_note( $this->payment_id, 'Stripe Customer ID: ' . $stripe_customer_id );

				// Save Stripe Customer ID into Donor meta.
				$this->stripe_gateway->save_stripe_customer_id( $stripe_customer_id, $this->payment_id );

				// Save customer id to donation.
				give_update_meta( $this->payment_id, '_give_stripe_customer_id', $stripe_customer_id );
			}

			try {
				$currencyCode = give_get_currency( $this->subscriptions['form_id'] );
				$stripePlan = give( RetrieveOrCreatePlan::class )->handle( SubscriptionDto::fromArray(
					[
						'formId' => $this->subscriptions['form_id'],
						'priceId' => $this->subscriptions['price_id'],
						'recurringDonationAmount' => Money::of( $this->subscriptions['recurring_amount'], $currencyCode ),
						'period' => $this->subscriptions['period'],
						'frequency' => $this->subscriptions['frequency'],
						'currencyCode' => $currencyCode,
					]
				)  );

			} catch ( Exception $e ) {
				Log::error(
					'Stripe Error',
					[
						'Description' => $e->getMessage(),
						'Subscription Data' => $this->subscriptions
					]
				);
				give_set_error(
					'give_recurring_stripe_create_subscription',
					esc_html__( 'An error occurred while processing the donation. Please try again.', 'give-recurring' )
				);
				give_send_back_to_checkout( '?payment-mode=stripe' );
			}

			$this->subscribe_customer_to_plan( $stripe_customer, $source_object, $stripePlan->id );
		}

		/**
		 * Subscribes a Stripe Customer to a plan.
		 *
		 * @param  \Stripe\Customer      $stripe_customer Stripe Customer Object.
		 * @param  string|\Stripe\Source $source          Stripe Source ID/Object.
		 * @param  string                $plan_id         Stripe Plan ID.
		 *
		 * @return bool|\Stripe\Subscription
		 */
		public function subscribe_customer_to_plan( $stripe_customer, $source, $plan_id ) {
			if ( $stripe_customer instanceof \Stripe\Customer ) {
				try {
					// Get metadata.
					$metadata = give_stripe_prepare_metadata( $this->payment_id, $this->purchase_data );
					$args     = array(
						'customer' => $stripe_customer->id,
						'items'    => array(
							array(
								'plan' => $plan_id,
							),
						),
						'metadata' => $metadata,
					);

					$args['default_payment_method'] = $source->id;

					$subscription                      = \Stripe\Subscription::create( $args, give_stripe_get_connected_account_options() );
					$this->subscriptions['profile_id'] = $subscription->id;

					// Need additional authentication steps as subscription is still incomplete.
					if ( 'incomplete' ===  $subscription->status ) {

						// Verify the initial payment with invoice created during subscription.
						$invoice = $this->invoice->retrieve( $subscription->latest_invoice );

						// Set Payment Intent ID.
						give_insert_payment_note( $this->payment_id, 'Stripe Payment Intent ID: ' . $invoice->payment_intent );

						// Retrieve payment intent details.
						$intent_details = $this->payment_intent->retrieve( $invoice->payment_intent );

						$confirm_args = array(
							'return_url' => give_get_success_page_uri(),
							'payment_method' => $source->id,
						);

						$intent_details->confirm( $confirm_args );

						// Record the subscription in Give.
						$this->record_signup();

						// Process additional authentication steps for SCA or 3D secure.
						give_stripe_process_additional_authentication( $this->payment_id, $intent_details );
					}

					return $subscription;
				} catch ( \Stripe\Error\Base $e ) {

					// There was an issue subscribing the Stripe customer to a plan.
					Give_Stripe_Logger::log_error( $e, $this->id );
				} catch ( Exception $e ) {

					// Something went wrong outside of Stripe.
					give_record_gateway_error(
						__( 'Stripe Error', 'give-recurring' ),
						sprintf(
							/* translators: %s Exception Message. */
							__( 'An error while subscribing a customer to a plan. Details: %s', 'give-recurring' ),
							$e->getMessage()
						)
					);
					give_set_error( 'Stripe Error', __( 'An error occurred while processing the donation. Please try again.', 'give-recurring' ) );
					give_send_back_to_checkout( '?payment-mode=stripe_google_pay' );
				} // End try().
			} // End if().
			return false;
		}

		/**
		 * Refund subscription charges and cancels the subscription if the parent donation triggered when refunding in wp-admin donation details.
		 *
		 * @access      public
		 * @since       1.1
		 *
		 * @param $payment Give_Payment
		 *
		 * @return      void
		 */
		public function process_refund( $payment ) {

			if ( empty( $_POST['give_refund_in_stripe'] ) ) {
				return;
			}
			$statuses = array( 'give_subscription', 'publish' );

			if ( ! in_array( $payment->old_status, $statuses ) ) {
				return;
			}

			if ( 'stripe_google_pay' !== $payment->gateway ) {
				return;
			}

			switch ( $payment->old_status ) {

				case 'give_subscription' :

					// Refund renewal payment
					if ( empty( $payment->transaction_id ) || $payment->transaction_id == $payment->ID ) {

						// No valid charge ID
						return;
					}

					try {

						$refund = \Stripe\Refund::create( array(
							'charge' => $payment->transaction_id,
						) );

						$payment->add_note( sprintf( __( 'Charge %1$s refunded in Stripe. Refund ID: %1$s', 'give-recurring' ), $payment->transaction_id, $refund->id ) );

					} catch ( Exception $e ) {

						// some sort of other error
						$body = $e->getJsonBody();
						$err  = $body['error'];

						if ( isset( $err['message'] ) ) {
							$error = $err['message'];
						} else {
							$error = __( 'Something went wrong while refunding the charge in Stripe.', 'give-recurring' );
						}

						wp_die( $error, __( 'Error', 'give-recurring' ), array(
							'response' => 400,
						) );

					}

					break;

				case 'publish' :

					// Refund & cancel initial subscription donation.
					$db   = new Give_Subscriptions_DB();
					$subs = $db->get_subscriptions( array(
						'parent_payment_id' => $payment->ID,
						'number'            => 100,
					) );

					if ( empty( $subs ) ) {
						return;
					}

					foreach ( $subs as $subscription ) {

						try {

							$refund = \Stripe\Refund::create( array(
								'charge' => $subscription->transaction_id,
							) );

							$payment->add_note( sprintf( __( 'Charge %s refunded in Stripe.', 'give-recurring' ), $subscription->transaction_id ) );
							$payment->add_note( sprintf( __( 'Charge %1$s refunded in Stripe. Refund ID: %1$s', 'give-recurring' ), $subscription->transaction_id, $refund->id ) );

						} catch ( Exception $e ) {

							// some sort of other error
							$body = $e->getJsonBody();
							$err  = $body['error'];

							if ( isset( $err['message'] ) ) {
								$error = $err['message'];
							} else {
								$error = __( 'Something went wrong while refunding the charge in Stripe.', 'give-recurring' );
							}

							$payment->add_note( sprintf( __( 'Charge %1$s could not be refunded in Stripe. Error: %1$s', 'give-recurring' ), $subscription->transaction_id, $error ) );

						}

						// Cancel subscription.
						$this->cancel( $subscription, false );
						$subscription->cancel();
						$payment->add_note( sprintf( __( 'Subscription %d cancelled.', 'give-recurring' ), $subscription->id ) );

					}

					break;

			}// End switch().

		}

		/**
		 * Generates source dictionary, used for testing purpose only.
		 *
		 * @param  array $card_info
		 *
		 * @return array
		 */
		public function generate_source_dictionary( $card_info = array() ) {

			if ( empty( $card_info ) ) {
				$card_info = $this->purchase_data['card_info'];
			}

			$card_info = array_map( 'trim', $card_info );
			$card_info = array_map( 'strip_tags', $card_info );

			return array(
				'object'    => 'card',
				'exp_month' => $card_info['card_exp_month'],
				'exp_year'  => $card_info['card_exp_year'],
				'number'    => $card_info['card_number'],
				'cvc'       => $card_info['card_cvc'],
				'name'      => $card_info['card_name'],
			);
		}


		/**
		 * Initial field validation before ever creating profiles or donors.
		 *
		 * Note: Please don't use this function. This function is for internal purposes only and can be removed
		 * anytime without notice.
		 *
		 * @access      public
		 * @since       1.0
		 *
		 * @param array $valid_data List of valid data.
		 * @param array $post_data  List of posted variables.
		 *
		 * @return      void
		 */
		public function validate_fields( $valid_data, $post_data ) {

			if (
				isset( $post_data['card_name'] ) &&
				empty( $post_data['card_name'] ) &&
				! isset( $post_data['is_payment_request'] )
			) {
				give_set_error( 'no_card_name', __( 'Please enter a name for the credit card.', 'give-recurring' ) );
			}

		}

		/**
		 * Can Sync.
		 *
		 * @param bool $ret
		 * @param Give_Subscription $subscription
		 *
		 * @return bool
		 */
		public function can_sync( $ret, $subscription ) {
			if (
				'stripe_google_pay' === $subscription->gateway &&
				! empty( $subscription->profile_id )
			) {
				$ret = true;
			}

			return $ret;
		}

		/**
		 * Can update subscription CC details.
		 *
		 * @since 1.7
		 *
		 * @param bool   $ret
		 * @param object $subscription
		 *
		 * @return bool
		 */
		public function can_update( $ret, $subscription ) {

			if (
				'stripe_google_pay' === $subscription->gateway
				&& ! empty( $subscription->profile_id )
				&& in_array( $subscription->status, array(
					'active',
					'failing',
				), true )
			) {
				return true;
			}

			return $ret;
		}

		/**
		 * @since 1.12.6
		 *
		 * @param bool $ret
		 * @param Give_Subscription $subscription
		 *
		 * @return bool
		 */
		public function can_update_subscription( $ret, $subscription ) {
			return $this->can_update( $ret, $subscription );
		}

		/**
		 * Stripe Recurring Customer ID.
		 *
		 * The Give Stripe gateway stores it's own customer_id so this method first checks for that, if it exists.
		 * If it does it will return that value. If it does not it will return the recurring gateway value.
		 *
		 * @param string $user_email Donor Email.
		 *
		 * @return string The donor's Stripe customer ID.
		 */
		public function get_stripe_recurring_customer_id( $user_email ) {

			// First check user meta to see if they have made a previous donation
			// w/ Stripe via non-recurring donation so we don't create a duplicate Stripe customer for recurring.
			$customer_id = give_stripe_get_customer_id( $user_email );

			// If no data found check the subscribers profile to see if there's a recurring ID already.
			if ( empty( $customer_id ) ) {

				$subscriber = new Give_Recurring_Subscriber( $user_email );

				$customer_id = $subscriber->get_recurring_donor_id( $this->id );
			}

			return $customer_id;

		}

		/**
		 * Get Stripe Subscription.
		 *
		 * @param $stripe_subscription_id
		 *
		 * @return mixed
		 */
		public function get_stripe_subscription( $stripe_subscription_id ) {

			$stripe_subscription = \Stripe\Subscription::retrieve( $stripe_subscription_id );

			return $stripe_subscription;

		}

		/**
		 * Get gateway subscription.
		 *
		 * @param $subscription
		 *
		 * @return bool|mixed
		 */
		public function get_gateway_subscription( $subscription ) {

			if ( $subscription instanceof Give_Subscription ) {

				$stripe_subscription_id = $subscription->profile_id;

				$stripe_subscription = $this->get_stripe_subscription( $stripe_subscription_id );

				return $stripe_subscription;
			}

			return false;
		}

		/**
		 * Get subscription details.
		 *
		 * @param Give_Subscription $subscription
		 *
		 * @return array|bool
		 */
		public function get_subscription_details( $subscription ) {

			$stripe_subscription = $this->get_gateway_subscription( $subscription );
			if ( false !== $stripe_subscription ) {

				$subscription_details = array(
					'status'         => $stripe_subscription->status,
					'created'        => $stripe_subscription->created,
					'billing_period' => $stripe_subscription->plan->interval,
					'frequency'      => $stripe_subscription->plan->interval_count,
				);

				return $subscription_details;
			}

			return false;
		}

		/**
		 * Get transactions.
		 *
		 * @param  Give_Subscription $subscription
		 * @param string             $date
		 *
		 * @return array
		 */
		public function get_gateway_transactions( $subscription, $date = '' ) {

			$subscription_invoices = $this->get_invoices_for_give_subscription( $subscription, $date = '' );
			$transactions          = array();

			foreach ( $subscription_invoices as $invoice ) {

				$transactions[] = array(
					'amount'         => give_stripe_cents_to_dollars( $invoice->amount_due ),
					'date'           => $invoice->created,
					'transaction_id' => $invoice->charge,
				);
			}

			return $transactions;
		}

		/**
		 * Get invoices for a Give subscription.
		 *
		 * @param Give_Subscription $subscription
		 * @param string            $date
		 *
		 * @return array
		 */
		private function get_invoices_for_give_subscription( $subscription, $date = '' ) {
			$subscription_invoices = array();

			if ( $subscription instanceof Give_Subscription ) {

				$stripe_subscription_id = $subscription->profile_id;

				/**
				 * Customer ID is also saved in the give_donationmeta table when a donation is made with Stripe PG
				 * We have to check if the customer ID is in the give_donationmeta table because if multiple Stripe accounts are connected,
				 * the same donor will have a different customer ID for each connected account.
				 */
				$stripe_customer_id = Give()->payment_meta->get_meta( $subscription->parent_payment_id, '_give_stripe_customer_id', true );

				if ( ! $stripe_customer_id ) {
					$stripe_customer_id = $this->get_stripe_recurring_customer_id( $subscription->donor->email );
				}

				$subscription_invoices  = $this->get_invoices_for_subscription( $stripe_customer_id, $stripe_subscription_id, $date );
			}

			return $subscription_invoices;
		}

		/**
		 * Get invoices for subscription.
		 *
		 * @param $stripe_customer_id
		 * @param $stripe_subscription_id
		 * @param $date
		 *
		 * @return array
		 */
		public function get_invoices_for_subscription( $stripe_customer_id, $stripe_subscription_id, $date ) {
			$subscription_invoices = array();
			$invoices              = $this->get_invoices_for_customer( $stripe_customer_id, $date );

			foreach ( $invoices as $invoice ) {
				if ( $invoice->subscription == $stripe_subscription_id ) {
					$subscription_invoices[] = $invoice;
				}
			}

			return $subscription_invoices;
		}

		/**
		 * Get invoices for Stripe customer.
		 *
		 * @param string $stripe_customer_id
		 * @param string $date
		 *
		 * @return array|bool
		 */
		private function get_invoices_for_customer( $stripe_customer_id = '', $date = '' ) {
			$args     = array(
				'limit' => 100,
				'status' => 'paid'
			);
			$has_more = true;
			$invoices = array();

			if ( ! empty( $date ) ) {
				$date_timestamp = strtotime( $date );
				$args['date']   = array(
					'gte' => $date_timestamp,
				);
			}

			if ( ! empty( $stripe_customer_id ) ) {
				$args['customer'] = $stripe_customer_id;
			}

			while ( $has_more ) {
				try {
					$collection             = \Stripe\Invoice::all( $args );
					$invoices               = array_merge( $invoices, $collection->data );
					$has_more               = $collection->has_more;
					$last_obj               = end( $invoices );
					$args['starting_after'] = $last_obj->id;

				} catch ( \Stripe\Error\Base $e ) {

					Give_Stripe_Logger::log_error( $e, $this->id );

					return false;

				} catch ( Exception $e ) {

					// Something went wrong outside of Stripe.
					give_record_gateway_error( __( 'Stripe Error', 'give-recurring' ), sprintf( __( 'The Stripe Gateway returned an error while getting invoices a Stripe customer. Details: %s', 'give-recurring' ), $e->getMessage() ) );

					return false;

				}
			}

			return $invoices;
		}

		/**
		 * Outputs the payment method update form
		 *
		 * @since  1.7
		 *
		 * @param  Give_Subscription $subscription The subscription object
		 *
		 * @return void
		 */
		public function update_payment_method_form( $subscription ) {

			if ( $subscription->gateway !== $this->id ) {
				return;
			}

			// addCreditCardForm() only shows when Stripe Checkout is enabled so we fake it
			add_filter( 'give_get_option_stripe_checkout', '__return_false' );

			// Remove Billing address fields.
			if ( has_action( 'give_after_cc_fields', 'give_default_cc_address_fields' ) ) {
				remove_action( 'give_after_cc_fields', 'give_default_cc_address_fields', 10 );
			}

			$form_id           = ! empty( $subscription->form_id ) ? absint( $subscription->form_id ) : 0;
			$args['id_prefix'] = "$form_id-1";
			$stripeCard = new Give_Stripe_Card();
			$stripeCard->addCreditCardForm( $form_id, $args );
		}

		/**
		 * @inheritdoc
		 */
		public function update_payment_method( $subscriber, $subscription, $data = null ) {

			if ( $data === null ) {
				$post_data = give_clean( $_POST );
			} else {
				$post_data = $data;
			}

			// Check for any existing errors.
			$errors    = give_get_errors();
			$form_id   = ! empty( $subscription->form_id ) ? $subscription->form_id : false;

			// Set App info.
			give_stripe_set_app_info( $form_id );

			if ( empty( $errors ) ) {

				$payment_method_id = ! empty( $post_data['give_stripe_payment_method'] ) ?
					$post_data['give_stripe_payment_method'] :
					false;
				$customer_id       = Give()->donor_meta->get_meta( $subscriber->id, give_stripe_get_customer_key(), true );

				// We were unable to retrieve the customer ID from meta so let's pull it from the API
				try {

					$stripe_subscription = \Stripe\Subscription::retrieve( $subscription->profile_id );

				} catch ( Exception $e ) {

					give_set_error( 'give_recurring_stripe_error', $e->getMessage() );
					return;
				}

				// If customer id doesn't exist, take the customer id from subscription.
				if ( empty( $customer_id ) ) {
					$customer_id = $stripe_subscription->customer;
				}

				try {

					$stripe_customer = \Stripe\Customer::retrieve( $customer_id );
				} catch ( Exception $e ) {

					give_set_error( 'give-recurring-stripe-customer-retrieval-error', $e->getMessage() );
					return;
				}

				$stripe_payment_method    = new Give_Stripe_Payment_Method();
				$give_stripe_subscription = new Give_Recurring_Stripe_Subscription();

				// No errors in stripe, continue on through processing.
				try {

					if ( $payment_method_id ) {
						if ( give_stripe_is_source_type( $payment_method_id, 'pm' ) ) {

							// Attach new payment method to customer.
							$payment_method        = $stripe_payment_method->retrieve( $payment_method_id );
							$payment_method->attach([
								'customer' => $customer_id,
							] );

							// Update the new payment method to Subscription.
							$give_stripe_subscription->update( $subscription->profile_id, [
								'default_payment_method' => $payment_method_id,
							] );

						} else {
							// Attach new source to customer.
							$stripe_customer->sources->create( array( 'source' => $payment_method_id ) );
							$stripe_customer->default_source = $payment_method_id;

							// Update the new source to Subscription.
							$give_stripe_subscription->update( $subscription->profile_id, [
								'default_source' => $payment_method_id,
							] );
						}

					} elseif ( ! empty( $post_data['give_stripe_existing_card'] ) ) {

						if ( give_stripe_is_source_type( $post_data['give_stripe_existing_card'], 'pm' ) ) {

							// Attach existing payment method to customer.
							$payment_method        = $stripe_payment_method->retrieve( $post_data['give_stripe_existing_card'] );
							$payment_method->attach([
								'customer' => $customer_id,
							] );

							// Update the existing payment method to Subscription.
							$give_stripe_subscription->update( $subscription->profile_id, [
								'default_payment_method' => $post_data['give_stripe_existing_card'],
							] );

						} else {
							// Attach existing source to customer.
							$stripe_customer->default_source = $post_data['give_stripe_existing_card'];
							$stripe_customer->save();

							// Update the existing source to Subscription.
							$give_stripe_subscription->update( $subscription->profile_id, [
								'default_source' => $post_data['give_stripe_existing_card'],
							] );

						}
					}

				} catch ( \Stripe\Error\Card $e ) {

					$body = $e->getJsonBody();
					$err  = $body['error'];

					if ( isset( $err['message'] ) ) {
						give_set_error( 'payment_error', $err['message'] );
					} else {
						give_set_error( 'payment_error', __( 'There was an error processing your payment, please ensure you have entered your card number correctly.', 'give-recurring' ) );
					}

				} catch ( \Stripe\Error\ApiConnection $e ) {

					$body = $e->getJsonBody();
					$err  = $body['error'];

					if ( isset( $err['message'] ) ) {
						give_set_error( 'payment_error', $err['message'] );
					} else {
						give_set_error( 'payment_error', __( 'There was an error processing your payment (Stripe\'s API is down), please try again', 'give-recurring' ) );
					}

				} catch ( \Stripe\Error\InvalidRequest $e ) {

					$body = $e->getJsonBody();
					$err  = $body['error'];

					// Bad Request of some sort. Maybe Christoff was here ;)
					if ( isset( $err['message'] ) ) {
						give_set_error( 'request_error', $err['message'] );
					} else {
						give_set_error( 'request_error', __( 'The Stripe API request was invalid, please try again', 'give-recurring' ) );
					}

				} catch ( \Stripe\Error\Api $e ) {

					$body = $e->getJsonBody();
					$err  = $body['error'];

					if ( isset( $err['message'] ) ) {
						give_set_error( 'request_error', $err['message'] );
					} else {
						give_set_error( 'request_error', __( 'The Stripe API request was invalid, please try again', 'give-recurring' ) );
					}

				} catch ( \Stripe\Error\Authentication $e ) {

					$body = $e->getJsonBody();
					$err  = $body['error'];

					// Authentication error. Stripe keys in settings are bad.
					if ( isset( $err['message'] ) ) {
						give_set_error( 'request_error', $err['message'] );
					} else {
						give_set_error( 'api_error', __( 'The API keys entered in settings are incorrect', 'give-recurring' ) );
					}

				} catch ( Exception $e ) {
					give_set_error( 'update_error', __( 'There was an error with this payment method. Please try with another card.', 'give-recurring' ) );
				}

			}

		}

		/**
		 * @inheritdoc
		 *
		 * @since 1.12.6 implement updateSubscriptionAmountOnStripe function
		 */
		public function update_subscription( $subscriber, $subscription, $data = null ) {
			if ( $data === null ) {
				$data = give_clean( $_POST ); // WPCS: input var ok, sanitization ok, CSRF ok.
			}
			$renewalAmount = $this->getNewRenewalAmount( $data );

			if ( give_get_errors() ) {
				return;
			}

			try{
				give( UpdateSubscriptionAmount::class )->handle( $subscription, $renewalAmount  );
			} catch ( Exception $e ) {
				give_set_error(
					'give_recurring_stripe_update_subscription',
					esc_html__(
						'The Stripe gateway returned an error while updating the subscription.',
						'give-recurring'
					)
				);

				Log::error(
					'Stripe Subscription Update Error',
					[
						'Description' => $e->getMessage(),
						'Subscription Data' => $subscription,
						'Renewal Amount' => $renewalAmount,
						'Subscriber' => $subscriber
					]
				);
			}
		}

		/**
		 * This function will record subscriptions processed using Stripe 3D secure payments.
		 *
		 * @todo   add post payment profile action hook if required in future.
		 *
		 * @param int            $donation_id Donation ID.
		 * @param \Stripe\Charge $charge      Stripe Charge Object.
		 * @param string         $customer_id Stripe Customer ID.
		 *
		 * @since  2.1
		 * @access public
		 */
		public function record_3dsecure_signup( $donation_id, $charge, $customer_id ) {

			// Proceed only, if donation is recurring.
			if ( give_get_meta( $donation_id, '_give_is_donation_recurring', true ) ) {

				// Set subscription_payment.
				give_update_meta( $donation_id, '_give_subscription_payment', true );

				// Retrieve temporary data for 3d secure payments.
				$subscription_args = give_get_payment_meta( $donation_id, '_give_recurring_stripe_subscription_args', true );
				$offsite           = give_get_payment_meta( $donation_id, '_give_recurring_stripe_subscription_is_offsite', true );

				// Now create the subscription record.
				$subscriber = new Give_Recurring_Subscriber( $customer_id );

				if ( isset( $subscription_args['status'] ) ) {
					$status = $subscription_args['status'];
				} else {
					$status = $offsite ? 'pending' : 'active';
				}

				// Set Subscription frequency.
				$frequency = ! empty( $subscription_args['frequency'] ) ? intval( $subscription_args['frequency'] ) : 1;

				$args = array(
					'form_id'           => give_get_payment_form_id( $donation_id ),
					'parent_payment_id' => $donation_id,
					'status'            => $status,
					'period'            => $subscription_args['period'],
					'frequency'         => $frequency,
					'initial_amount'    => $subscription_args['initial_amount'],
					'recurring_amount'  => $subscription_args['recurring_amount'],
					'bill_times'        => $subscription_args['bill_times'],
					'expiration'        => $subscriber->get_new_expiration( $subscription_args['id'], $subscription_args['price_id'], $frequency ),
					'profile_id'        => $subscription_args['profile_id'],
					'transaction_id'    => $subscription_args['transaction_id'],
				);

				// Support user_id if it is present is purchase_data.
				if ( isset( $this->purchase_data['user_info']['id'] ) ) {
					$args['user_id'] = '';
				}

				$subscriber->add_subscription( $args );

				if ( ! $offsite ) {
					// Offsite payments get verified via a webhook so are completed in webhooks().
					give_update_payment_status( $donation_id, 'publish' );
				}

				// Delete temporary data required for successful 3d secure payments.
				give_delete_meta( $donation_id, '_give_recurring_stripe_subscription_args', true );
				give_delete_meta( $donation_id, '_give_recurring_stripe_subscription_is_offsite', true );

			}
		}

		/**
		 * Can Cancel.
		 *
		 * @param bool $canCancel The value being filtered.
		 * @param $subscription
		 *
		 * @access public
		 *
		 * @since  1.9.0
		 * @since 1.12.2 Return the original filtered value if no change so that failing subscriptions can be canceled.
		 *
		 * @return bool
		 */
		public function can_cancel( $canCancel, $subscription ) {
			if( $subscription->gateway === $this->id ) {
				$canCancel = give_recurring_stripe_can_cancel( $canCancel, $subscription );
			}
			return $canCancel;
		}

		/**
		 * Cancel subscription on stripe.
		 *
		 * @since 1.12.3
		 *
		 * @param Give_Subscription $subscription
		 * @param bool $valid
		 *
		 * @return bool
		 */
		public function cancel( $subscription, $valid ) {
			$stripeCreditCardPaymentMethod = new Give_Recurring_Stripe();
			return $stripeCreditCardPaymentMethod->cancel( $subscription, $valid );
		}

		/**
		 * Link the recurring profile in Stripe.
		 *
		 * @since  1.9.0
		 *
		 * @param  string $profile_id   The recurring profile id.
		 * @param  object $subscription The Subscription object.
		 *
		 * @return string               The link to return or just the profile id.
		 */
		public function link_profile_id( $profile_id, $subscription ) {

			if ( ! empty( $profile_id ) ) {
				$payment    = new Give_Payment( $subscription->parent_payment_id );
				$html       = '<a href="%s" target="_blank">' . $profile_id . '</a>';
				$base_url   = 'live' === $payment->mode ? 'https://dashboard.stripe.com/' : 'https://dashboard.stripe.com/test/';
				$link       = esc_url( $base_url . 'subscriptions/' . $profile_id );
				$profile_id = sprintf( $html, $link );
			}

			return $profile_id;

		}
	}
}

new Give_Recurring_Stripe_Google_Pay();
