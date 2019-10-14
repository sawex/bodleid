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
    $password = sanitize_text_field( $_POST['data']['user_password'] );

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
    /* @var string $email */
    $email = sanitize_text_field( $_POST['data']['billing_email'] );

    /* @var string $password */
    $password = sanitize_text_field( $_POST['data']['password'] );

    /* @var string $sign_up_nonce */
    $sign_up_nonce = $_POST['data']['sign_up_nonce'];

    /* @var array $fields Accepted form fields */
    $fields = [
      'billing_first_name',
      'billing_last_name',
      'billing_email',
      'billing_phone',
      'billing_company',
      'billing_address_1',
      'billing_city',
      'billing_postcode',
      'billing_postcode',
      'billing_state',
    ];

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
      wp_die();
    }

    foreach ( $fields as $field ) {
      if ( ! empty( $_POST['data'][$field] ) ) {

        /* @var string $value Data from POST request */
        $value = sanitize_text_field( $_POST['data'][$field] );

        if ( $field === 'password' && ! empty( $value ) ) {
          wp_set_password( $value, $user_id );
        }

        update_user_meta( $user_id, $field, $value );
      }
    }

    wc_update_new_customer_past_orders( $user_id );

    wp_set_auth_cookie( $user_id );

    wp_send_json_success( [ 'status' => 'OK' ] );

  } catch ( Exception $e ) {
    wp_send_json_error( [ 'error' => $e ] );
  }
  wp_die();
}

/**
 * Register AJAX handler for user account data updating
 *
 * @version 1.0.0
 */
function mst_bodleid_update_account_data() {
  try {
    /* @var int $user_id */
    $user_id = get_current_user_id();

    /* @var string $nonce */
    $nonce = $_POST['data']['update_account_data_nonce'];

    if ( ! $user_id ) {
      wp_send_json_error( [ 'error' => __( 'Please, login to update your account', 'mst_bodleid' ) ] );
      wp_die();
    }

    if ( ! wp_verify_nonce( $nonce, 'update_account_data' ) ) {
      wp_send_json_error( [ 'error' => __( 'Nonce error', 'mst_bodleid' ) ] );
      wp_die();
    }

    /* @var array $fields Accepted form fields */
    $fields = [
      'billing_first_name',
      'billing_last_name',
      'billing_email',
      'billing_phone',
      'password',
      'billing_company',
      'billing_address_1',
      'billing_city',
      'billing_postcode',
      'billing_postcode',
      'billing_state',
    ];

    foreach ( $fields as $field ) {
      if ( ! empty( $_POST['data'][$field] ) ) {

        /* @var string $value Data from POST request */
        $value = sanitize_text_field( $_POST['data'][$field] );

        if ( $field === 'password' && ! empty( $value ) ) {
          wp_set_password( $value, $user_id );
        }

        update_user_meta( $user_id, $field, $value );
      }
    }

    wc_update_new_customer_past_orders( $user_id );

    wp_send_json_success( [ 'status' => 'OK' ] );

  } catch ( Exception $e ) {
    wp_send_json_error( [ 'error' => $e ] );
  }
  wp_die();
}

/**
 * COMPARING
 */
function mst_bodleid_add_to_comparing() {
  try {
    $product_id = (int) $_POST['data']['product_id'];

    $list = WC()->session->get( 'mst_bodleid_comparing_list' );

    if ( ! in_array( $product_id, $list ) ) {
      $list[] = $product_id;
      WC()->session->set( 'mst_bodleid_comparing_list', $list );
    }

    wp_send_json_success( [ 'status' => wp_json_encode( $list ) ] );

  } catch ( Exception $e ) {
    wp_send_json_error( [ 'error' => $e ] );
  }

  wp_die();
}

function mst_bodleid_remove_from_comparing() {
  try {
    $product_id = (int) $_POST['data']['product_id'];

    $list = WC()->session->get( 'mst_bodleid_comparing_list' );

    if ( in_array( $product_id, $list ) ) {
      $i = array_search( $product_id, $list );
      unset( $list[$i] );
      WC()->session->set( 'mst_bodleid_comparing_list', $list );
    }

    wp_send_json_success( [ 'status' => wp_json_encode( $list ) ] );

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

add_action( 'wp_ajax_mst_bodleid_add_to_comparing', 'mst_bodleid_add_to_comparing' );
add_action( 'wp_ajax_nopriv_mst_bodleid_add_to_comparing', 'mst_bodleid_add_to_comparing' );

add_action( 'wp_ajax_mst_bodleid_remove_from_comparing', 'mst_bodleid_remove_from_comparing' );
add_action( 'wp_ajax_nopriv_mst_bodleid_remove_from_comparing', 'mst_bodleid_remove_from_comparing' );

add_action( 'wp_ajax_mst_bodleid_update_account_data', 'mst_bodleid_update_account_data' );
add_action( 'wp_ajax_nopriv_mst_bodleid_update_account_data', 'mst_bodleid_update_account_data' );