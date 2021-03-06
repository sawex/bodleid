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
      'billing_email',
      'billing_phone',
      'billing_company',
      'billing_address_1',
      'billing_city',
      'billing_postcode',
      'billing_ssn',
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

    update_user_meta( $user_id, 'billing_country', 'IS' );


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
      'billing_email',
      'billing_phone',
      'password',
      'billing_company',
      'billing_address_1',
      'billing_city',
      'billing_postcode',
      'billing_ssn',
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

/**
 * Register AJAX handler for add to compare list.
 *
 * @version 1.0.0
 */
function mst_bodleid_add_to_comparing() {
  try {
    /* @var int $product_id */
    $product_id = (int) $_POST['data']['product_id'];

    /* @var array $list */
    $list = (array) WC()->session->get( 'mst_bodleid_comparing_list' );

    if ( ! in_array( $product_id, $list ) ) {
      $list[] = $product_id;
      WC()->session->set( 'mst_bodleid_comparing_list', $list );
    } else {
      wp_send_json_error( [ 'error' => 'Product is already in your compare list' ] );
      wp_die();
    }

    wp_send_json_success( [ 'status' => wp_json_encode( $list ) ] );

  } catch ( Exception $e ) {
    wp_send_json_error( [ 'error' => $e ] );
  }

  wp_die();
}

/**
 * Register AJAX handler for removing from compare list.
 *
 * @version 1.0.0
 */
function mst_bodleid_remove_from_comparing() {
  try {
    /* @var int $product_id */
    $product_id = (int) $_POST['data']['product_id'];

    /* @var array $list */
    $list = (array) WC()->session->get( 'mst_bodleid_comparing_list' );

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

/**
 * RESTORE PASSWORD
 * */

/**
 * Register AJAX handler for email getting, restore key generation and email sending.
 *
 * @version 1.0.0
 */
function mst_bodleid_restore_password_first() {
  try {
    /* @var string $email */
    $email = sanitize_email( $_POST['data']['restore-email'] );

    /* @var string $nonce */
    $nonce = $_POST['data']['restore_password_nonce'];

    if ( ! wp_verify_nonce( $nonce, 'restore-password' ) ) {
      wp_send_json_error( [ 'error' => __( 'Nonce error', 'mst_bodleid' ) ] );
      wp_die();
    }

    if ( ! is_email( $email ) ) {
      wp_send_json_error( [ 'error' => __( 'Wrong email format', 'mst_bodleid' ) ] );
      wp_die();
    }

    /* @var bool|int $user_id */
    $user_id = email_exists( $email );

    if ( ! is_bool( $user_id ) ) {
      /* @var WP_User|false $user */
      $user = get_user_by( 'id', $user_id );

      /* @var string|WP_Error $reset_key */
      $reset_key = get_password_reset_key( $user );

      /* @var string $user_login */
      $user_login = $user->user_login;

      /* @var string $url */
      $url = add_query_arg( [
        'key' => $reset_key,
        'login' => $user_login,
      ], mst_bodleid_lostpassword_url() );

      $message = mst_bodleid_get_forgot_password_url_email_template( $user_login, $url );

      wp_mail(
        $email,
        sprintf( _x( '[%s] Password recovery', 'Site name', 'mst_bodleid' ), get_bloginfo( 'name' ) ),
        $message,
        [ 'content-type: text/html' ]
      );
    }

    wp_send_json_success( [ 'status' => 'OK' ] );

  } catch ( Exception $e ) {
    wp_send_json_error( [ 'error' => $e ] );
  }

  wp_die();
}

/**
 * Register AJAX handler for password updating.
 *
 * @version 1.0.0
 */
function mst_bodleid_restore_password_second() {
  try {
    /* @var string $password */
    $password = sanitize_text_field( $_POST['data']['new_password_first'] );

    /* @var string $user_login */
    $user_login = $_POST['data']['login'];

    /* @var string $reset_key User account restore key */
    $reset_key = $_POST['data']['key'];

    /* @var string $nonce */
    $nonce = $_POST['data']['new_password_nonce'];

    if ( ! wp_verify_nonce( $nonce, 'new-password' ) ) {
      wp_send_json_error( [ 'error' => __( 'Nonce error', 'mst_bodleid' ) ] );
      wp_die();
    }

    /* @var null|WP_User|WP_Error */
    $user = check_password_reset_key( $reset_key, $user_login );

    if ( is_wp_error( $user ) ) {
      wp_send_json_error( [ 'error' => $user->get_error_message() ] );
      wp_die();
    }

    if ( wp_check_password( $password, $user->user_pass, $user->ID ) ) {
      wp_send_json_error( [ 'error' => __( 'You cannot use your old password', 'mst_bodleid' ) ] );
      wp_die();
    }

    wp_set_password( $password, $user->ID );
    wp_send_json_success( [ 'status' => 'OK' ] );

  } catch ( Exception $e ) {
    wp_send_json_error( [ 'error' => $e ] );
  }

  wp_die();
}

/**
 * MISC
 * */

/**
 * Register AJAX handler for WC add to cart products adding.
 *
 * @version 1.0.0
 */
function woocommerce_ajax_add_to_cart() {
  /* @var int $product_id */
  $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );

  /* @var int $quantity */
  $quantity = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );

  /* @var int $variation_id */
  $variation_id = absint( $_POST['variation_id'] ) ?: 0;

  /* @var bool $variation_id */
  $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

  /* @var false|string $product_status */
  $product_status = get_post_status( $product_id );

  if ( $passed_validation &&
       WC()->cart->add_to_cart( $product_id, $quantity, $variation_id ) &&
       'publish' === $product_status
     ) {
    do_action( 'woocommerce_ajax_added_to_cart', $product_id );

    WC_AJAX::get_refreshed_fragments();
  } else {
    wp_send_json_error( [
      'error' => true,
      'product_url' => apply_filters(
        'woocommerce_cart_redirect_after_error',
        get_permalink( $product_id ),
        $product_id
      ),
    ] );
  }

  wp_die();
}

add_action( 'wp_ajax_mst_bodleid_cb', 'mst_bodleid_handleCallback' );
add_action( 'wp_ajax_nopriv_mst_bodleid_cb', 'mst_bodleid_handleCallback' );

add_action( 'wp_ajax_mst_bodleid_login', 'mst_bodleid_login' );
add_action( 'wp_ajax_nopriv_mst_bodleid_login', 'mst_bodleid_login' );

add_action( 'wp_ajax_mst_bodleid_sign_up', 'mst_bodleid_sign_up' );
add_action( 'wp_ajax_nopriv_mst_bodleid_sign_up', 'mst_bodleid_sign_up' );

add_action( 'wp_ajax_mst_bodleid_update_account_data', 'mst_bodleid_update_account_data' );
add_action( 'wp_ajax_nopriv_mst_bodleid_update_account_data', 'mst_bodleid_update_account_data' );

add_action( 'wp_ajax_mst_bodleid_add_to_comparing', 'mst_bodleid_add_to_comparing' );
add_action( 'wp_ajax_nopriv_mst_bodleid_add_to_comparing', 'mst_bodleid_add_to_comparing' );

add_action( 'wp_ajax_mst_bodleid_remove_from_comparing', 'mst_bodleid_remove_from_comparing' );
add_action( 'wp_ajax_nopriv_mst_bodleid_remove_from_comparing', 'mst_bodleid_remove_from_comparing' );

add_action( 'wp_ajax_mst_bodleid_restore_password_first', 'mst_bodleid_restore_password_first' );
add_action( 'wp_ajax_nopriv_mst_bodleid_restore_password_first', 'mst_bodleid_restore_password_first' );

add_action( 'wp_ajax_mst_bodleid_restore_password_second', 'mst_bodleid_restore_password_second' );
add_action( 'wp_ajax_nopriv_mst_bodleid_restore_password_second', 'mst_bodleid_restore_password_second' );

add_action( 'wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart' );