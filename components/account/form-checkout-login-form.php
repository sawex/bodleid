<?php
/**
 * Template part for displaying sign in form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 * @since 1.0.0
 */

/* @var string $login_text */
$login_text = wp_kses_post( get_field( 'account', 'option' )['login_text'] );
?>

<div class="login__form login__form--login-checkout-visible">
  <h3 class="tertiary-title login__title login__title--active">
    <?php esc_html_e( 'Log in', 'mst_bodleid' ); ?>
  </h3>

  <p class="text login__text"><?php echo $login_text; ?></p>

  <div class="login__input-wrap">
    <div class="form__input-box">
      <input class="form__input" type="text" name="email" id="login-email-field" form="checkout-login-form">
      <label class="form__label" for="login-email-field">
        <?php esc_html_e( 'Email*', 'mst_bodleid' ); ?>
      </label>
    </div>

    <div class="form__input-box">
      <input class="form__input"
             type="password"
             name="user_password"
             id="login-password-field"
             form="checkout-login-form">
      <label class="form__label" for="login-password-field">
        <?php esc_html_e( 'Password*', 'mst_bodleid' ); ?>
      </label>
    </div>
  </div>

  <input class="login__form-btn"
         value="<?php esc_attr_e( 'Log in', 'mst_bodleid' ); ?>"
         aria-label="<?php esc_attr_e( 'Log in', 'mst_bodleid' ); ?>"
         type="submit"
         form="checkout-login-form">

  <input class="login__remember-input"
         type="checkbox"
         name="remember"
         id="remember-me-check"
         form="checkout-login-form">
  <label class="login__remember-label" for="remember-me-check">
    <?php esc_html_e( 'Remember me', 'mst_bodleid' ); ?>
  </label>

  <a href="<?php echo mst_bodleid_lostpassword_url(); ?>" class="login__forgotten-password">
    <?php esc_html_e( 'Forgotten password?', 'mst_bodleid' ); ?>
  </a>
</div>
