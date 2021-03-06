<?php

namespace GiveRecurring\Webhooks\AuthorizeNet\Listeners;

use GiveRecurring\Webhooks\Contracts\EventListener;
use Give_Subscription;
use GiveRecurring\Infrastructure\Log;

/**
 * Class PaymentAuthCaptureCreated
 * @package GiveRecurring\Webhooks\AuthorizeNet\Listeners
 *
 * @since 1.12.6
 */
class PaymentAuthCaptureCreated implements EventListener
{
    /**
     * @inheritDoc
     *
     * @return void
     */
    public function processEvent($event)
    {
        $transactionId = isset($event->payload->id) ? $event->payload->id : '';

        // Must have the transaction id.
        if (empty($transactionId)) {
            return;
        }

        // Is this payment already recorded?
        if (give_get_purchase_id_by_transaction_id($transactionId)) {
            return;
        }

        // Ok setup API request.
        $request = Give_Authorize()->payments->setup_api_request();

        // Get transaction details from API.
        /* @var object $transactionDetail */
        $transactionDetail = $request->getTransactionDetailsRequest([
            'transId' => $transactionId,
        ]);

        $subscriptionProfileId = isset($transactionDetail->transaction->subscription->id) ? $transactionDetail->transaction->subscription->id : '';

        // Must have subscription id to continue.
        if (empty($subscriptionProfileId)) {
            Log::error(
                'Authorize.net Webhook Error',
                [
                    'Description'      => 'The Recurring Authorize.net gateway could not find the subscription profile ID from the webhook data.',
                    'Event Data'       => $event,
                    'Transaction Data' => $transactionDetail
                ]
            );

            return;
        }

        $subscription = new Give_Subscription($subscriptionProfileId, true);

        // Check for subscription ID.
        if (0 === $subscription->id) {
            Log::error(
                'Authorize.net Webhook Error',
                [
                    'Description'      => 'Give could not find the donor\'s subscription within the database from the response provided by the Authorize.net webhook.',
                    'Event Data'       => $event,
                    'Transaction Data' => $transactionDetail
                ]
            );

            return;
        }

        // Need the subscription payment number.
        if ( ! isset($transactionDetail->transaction->subscription->payNum)) {
            Log::error(
                'Authorize.net Webhook Error',
                [
                    'Description'      => 'The Recurring Authorize.net gateway could not find the subscription payment number from the webhook data provided.',
                    'Event Data'       => $event,
                    'Transaction Data' => $transactionDetail
                ]
            );

            return;
        }


        $args = [
            'amount'         => $transactionDetail->transaction->authAmount,
            'transaction_id' => $transactionId,
            'gateway'        => $subscription->gateway,
        ];

        // We have a renewal.
        $subscription->add_payment($args);
        $subscription->renew();
    }
}