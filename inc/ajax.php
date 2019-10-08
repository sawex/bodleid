<?php
/**
 * AJAX handlers
 *
 * @link https://codex.wordpress.org/AJAX
 *
 * @package Bodleid
 */

/**
* Register AJAX handler for callback forms
*/
function mst_bodleid_handleCallback() {
  try {
    $name = sanitize_text_field( $_POST['data']['name'] ) ?: '-';
    $email = sanitize_email( $_POST['data']['email'] ) ?: '-';
    $phone = sanitize_text_field( $_POST['data']['phone'] ) ?: '-';
    $company = sanitize_text_field( $_POST['data']['company'] ) ?: '-';
    $message = sanitize_textarea_field( $_POST['data']['message'] ) ?: '-';

    wp_mail(
      get_option( 'admin_email' ),
      __( 'There is a new submitted form on Bodleid', 'mst_bodleid' ),
      "Name: $name \n Email: $email \n Phone: $phone \n Company: $company \n Message: $message"
    );

    wp_send_json_success( [ 'status' => 'OK' ] );

  } catch ( Exception $e ) {
    wp_send_json_error( [ 'error' => $e ] );
  }

  wp_die();
}

/**
 * Register AJAX handler for user login form
 */
function mst_bodleid_login() {
  try {
    $username = sanitize_text_field( $_POST['data']['email'] );
    $password = sanitize_text_field( $_POST['data']['password'] );
    $remember = ! empty( $_POST['data']['remember'] ) ? true : false;

    if ( ! $username || ! $password ) {
      wp_send_json_error( [ 'error' => __( 'Invalid username or password', 'mst_bodleid' ) ] );
      wp_die();
    }

    $auth = wp_authenticate( $username, $password );

    if ( is_wp_error( $auth ) ) {
      wp_send_json_error( [ 'error' => __( 'Invalid username or password', 'mst_bodleid' ) ] );
    } else {
      wp_set_auth_cookie( $auth->ID, $remember );
    }

    wp_send_json_success( [ 'status' => 'OK' ] );

  } catch ( Exception $e ) {
    wp_send_json_error( [ 'error' => $e ] );
  }

  wp_die();
}

/**
 * Returns user orders by page number
 */
function mst_bodleid_user_orders() {
  try {
    $page = (int) sanitize_text_field( $_POST['data']['page'] );
    $user_id = get_current_user_id();

    if ( ! $user_id ) {
      wp_send_json_error( [ 'error' => 'Log in to get this information' ] );
      wp_die();
    }

    $orders = wc_get_orders( [
      'customer_id' => $user_id,
      'limit' => 4,
      'paged' => $page ?: 1,
    ] );

    wp_send_json_success( [ 'status' => wp_json_encode( $orders ) ] );

  } catch ( Exception $e ) {
    wp_send_json_error( [ 'error' => $e ] );
  }

  wp_die();
}

add_action( 'wp_ajax_mst_bodleid_cb', 'mst_bodleid_handleCallback' );
add_action( 'wp_ajax_nopriv_mst_bodleid_cb', 'mst_bodleid_handleCallback' );

add_action( 'wp_ajax_mst_bodleid_login', 'mst_bodleid_login' );
add_action( 'wp_ajax_nopriv_mst_bodleid_login', 'mst_bodleid_login' );

add_action( 'wp_ajax_mst_bodleid_user_orders', 'mst_bodleid_user_orders' );
add_action( 'wp_ajax_nopriv_mst_bodleid_user_orders', 'mst_bodleid_user_orders' );