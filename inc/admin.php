<?php
/**
 * Admin panel helpers
 *
 * @link https://woocommerce.com/
 *
 * @package Bodleid
 */

/**
 * Adds SSN field to edit order page.
 *
 * @param WC_Order $order
 */
function mst_bodleid_add_wc_order_page_ssn( $order ) {
  /* @var string $ssn */
  $ssn = get_post_meta( $order->get_id(), 'billing_ssn', true );

  printf( '<p><strong>%s</strong><br/>%s</p>', __( 'SSN', 'mst_bodleid' ), $ssn );
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'mst_bodleid_add_wc_order_page_ssn', 10 );
