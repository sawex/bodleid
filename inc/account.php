<?php
/**
 * User account helpers
 *
 * @link https://codex.wordpress.org/AJAX
 *
 * @package Bodleid
 */

if ( ! function_exists( 'mst_bodleid_get_sign_up_form' ) ) {
  /**
   * Returns different registration forms depends on parameter
   *
   * @param string $type Type of sign up form
   *
   * @return void
   */
  function mst_bodleid_the_sign_up_form( $type = 'registration-page' ) {
    switch ( $type ) {
      case 'account-page':
        get_template_part( 'components/account/form', 'account' );
        break;
      case 'checkout-page':
        get_template_part( 'components/account/form', 'checkout' );
        break;
      default:
        get_template_part( 'components/account/form', 'register' );
    }
  }
}