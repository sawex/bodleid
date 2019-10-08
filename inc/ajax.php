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
    /* @var string $email */
    $email = sanitize_text_field( $_POST['data']['email'] );

    /* @var string $password */
    $password = sanitize_text_field( $_POST['data']['password'] );

    /* @var bool $remember */
    $remember = ! empty( $_POST['data']['remember'] ) ? true : false;

    /* @var string $sign_up_nonce */
    $login_nonce = $_POST['data']['login_nonce'];

    if ( ! wp_verify_nonce( $login_nonce, 'login' ) ) {
      wp_send_json_error( [ 'error' => __( 'Nonce error', 'mst_bodleid' ) ] );
      wp_die();
    }

    if ( ! $email || ! $password ) {
      wp_send_json_error( [ 'error' => __( 'Invalid username or password', 'mst_bodleid' ) ] );
      wp_die();
    }

    $auth = wp_authenticate( $email, $password );

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


/**
 * Register AJAX handler for user sign up form
 *
 * @version 1.0.0
 */
function mst_bodleid_sign_up() {
  try {
    /* @var string $first_name */
    $first_name = sanitize_text_field( $_POST['data']['name'] );

    /* @var string $last_name */
    $last_name = sanitize_text_field( $_POST['data']['extensions'] );

    /* @var string $email */
    $email = sanitize_text_field( $_POST['data']['email'] );

    /* @var string $phone */
    $phone = sanitize_text_field( $_POST['data']['phone'] );

    /* @var string $password */
    $password = sanitize_text_field( $_POST['data']['password'] );

    /* @var string $company */
    $company = sanitize_text_field( $_POST['data']['company'] );

    /* @var string $address */
    $address = sanitize_text_field( $_POST['data']['address'] );

    /* @var string $city */
    $city = sanitize_text_field( $_POST['data']['city'] );

    /* @var string $zip */
    $zip = sanitize_text_field( $_POST['data']['zip'] );

    /* @var string $country */
    $country = sanitize_text_field( $_POST['data']['country'] );

    /* @var string $region */
    $region = sanitize_text_field( $_POST['data']['region'] );

    /* @var string $sign_up_nonce */
    $sign_up_nonce = $_POST['data']['sign_up_nonce'];

    if ( ! wp_verify_nonce( $sign_up_nonce, 'sign_up' ) ) {
      wp_send_json_error( [ 'error' => __( 'Nonce error', 'mst_bodleid' ) ] );
      wp_die();
    }

    if ( empty( $email ) || empty( $password ) ) {
      wp_send_json_error( [ 'error' => __( 'Invalid username or password', 'mst_bodleid' ) ] );
      wp_die();
    }

    /* @var string $username */
    $username = explode( '@', $email )[0];

    /* @var int|WP_Error $user_id */
    $user_id = wp_create_user( $username, $password, $email );

    if ( is_wp_error( $user_id ) ) {
      wp_send_json_error( [ 'error' => $user_id->get_error_message() ] );
    }

    update_user_meta( $user_id, 'guest', 'yes' );

    update_user_meta( $user_id, 'billing_address_1', $address );
    update_user_meta( $user_id, 'billing_city', $city );
    update_user_meta( $user_id, 'billing_company', $company );
    update_user_meta( $user_id, 'billing_country', $country );
    update_user_meta( $user_id, 'billing_email', $email );
    update_user_meta( $user_id, 'billing_first_name', $first_name );
    update_user_meta( $user_id, 'billing_last_name', $last_name );
    update_user_meta( $user_id, 'billing_phone', $phone );
    update_user_meta( $user_id, 'billing_postcode', $zip );
    update_user_meta( $user_id, 'billing_state', $region );

    update_user_meta( $user_id, 'shipping_address_1', $address );
    update_user_meta( $user_id, 'shipping_city', $city );
    update_user_meta( $user_id, 'shipping_company', $company );
    update_user_meta( $user_id, 'shipping_country', $country );
    update_user_meta( $user_id, 'shipping_email', $email );
    update_user_meta( $user_id, 'shipping_first_name', $first_name );
    update_user_meta( $user_id, 'shipping_last_name', $last_name );
    update_user_meta( $user_id, 'shipping_phone', $phone );
    update_user_meta( $user_id, 'shipping_postcode', $zip );
    update_user_meta( $user_id, 'shipping_state', $region );

    wc_update_new_customer_past_orders( $user_id );

    wp_set_auth_cookie( $user_id );

    wp_send_json_success( [ 'status' => 'OK' ] );

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

add_action( 'wp_ajax_mst_bodleid_sign_up', 'mst_bodleid_sign_up' );
add_action( 'wp_ajax_nopriv_mst_bodleid_sign_up', 'mst_bodleid_sign_up' );