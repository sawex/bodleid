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
    $username = sanitize_text_field( $_POST['data']['username'] );
    $password = sanitize_text_field( $_POST['data']['password'] );

    if ( ! $username || ! $password ) {
      wp_send_json_error( [ 'error' => __( 'Invalid username or password', 'mst_bodleid' ) ] );
      wp_die();
    }

    $auth = wp_authenticate( $username, $password );

    if ( is_wp_error( $auth ) ) {
      wp_send_json_error( [ 'error' => __( 'Invalid username or password', 'mst_bodleid' ) ] );
    } else {
      wp_set_auth_cookie( $auth->ID );
    }

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