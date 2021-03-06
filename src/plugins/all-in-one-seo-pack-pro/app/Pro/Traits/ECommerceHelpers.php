<?php
namespace AIOSEO\Plugin\Pro\Traits;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Contains helper functions for eCommerce plugins.
 *
 * @since 4.0.13
 */
trait ECommerceHelpers {

	/**
	 * Returns the first WooCommerce brand if there is one.
	 *
	 * Supports the WooCommerce Brands and Perfect Brands plugins.
	 *
	 * @since 4.0.13
	 *
	 * @param  int    $id The product ID.
	 * @return string     The product brand.
	 */
	public function getWooCommerceBrand( $id = null ) {
		$isWooCommerceBrandsActive = $this->isWooCommerceBrandsActive();
		$isPerfectBrandsActive     = $this->isPerfectBrandsActive();
		if ( ! $this->isWooCommerceActive() || ( ! $isWooCommerceBrandsActive && ! $isPerfectBrandsActive ) ) {
			return '';
		}

		$product = $this->getPost( $id );
		if ( ! is_object( $product ) || 'product' !== $product->post_type ) {
			return '';
		}

		$brandTaxonomy = $isWooCommerceBrandsActive ? 'product_brand' : 'pwb-brand';
		if ( ! taxonomy_exists( $brandTaxonomy ) ) {
			return '';
		}

		$terms = get_the_terms( $product->ID, $brandTaxonomy );
		return ! empty( $terms[0]->name ) ? $terms[0]->name : '';
	}

	/**
	 * Checks if the WooCommerce Brands plugin is active.
	 *
	 * @since 4.0.13
	 *
	 * @return boolean Whether the plugin is active.
	 */
	public function isWooCommerceBrandsActive() {
		return class_exists( 'WC_Brands' );
	}

	/**
	 * Checks if the Perfect Brands plugin is active.
	 *
	 * @since 4.0.13
	 *
	 * @return boolean Whether the plugin is active.
	 */
	public function isPerfectBrandsActive() {
		return class_exists( '\Perfect_WooCommerce_Brands\Perfect_Woocommerce_Brands' );
	}

	/**
	 * Checks whether EDD is active.
	 *
	 * @since 4.0.13
	 *
	 * @return boolean Whether EDD is active.
	 */
	public function isEddActive() {
		return class_exists( 'Easy_Digital_Downloads' );
	}

	/**
	 * Checks whether EDD Reviews is active.
	 *
	 * @since 4.0.13
	 *
	 * @return boolean Whether EDD Reviews is active.
	 */
	public function isEddReviewsActive() {
		return class_exists( 'EDD_Reviews' );
	}
}