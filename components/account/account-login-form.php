<?php
/**
 * Template part for displaying sign in form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 * @since 1.0.0
 */
?>

<form class="login__form">
  <h3 class="tertiary-title login__title login__title--active">
    <?php esc_html_e( 'Log in', 'mst_bodleid' ); ?>
  </h3>

  <p class="text login__text">
    <?php
    esc_html_e(
      'Bidding route offers a complete solution in telephone and online language for small and 
                    large companies and hotels, from telephone networks to internal online affairs and connection 
                    to the world',
      'mst_bodleid'
    );
    ?>
  </p>

  <div class="login__input-wrap">
    <div class="form__input-box">
      <input class="form__input" type="text" name="email" id="email-field">
      <label class="form__label" for="email-field">
        <?php esc_html_e( 'Email*', 'mst_bodleid' ); ?>
      </label>
    </div>

    <div class="form__input-box">
      <input class="form__input" type="password" name="password" id="password-field">
      <label class="form__label" for="password-field">
        <?php esc_html_e( 'Password*', 'mst_bodleid' ); ?>
      </label>
    </div>
  </div>

  <input class="login__form-btn"
         value="<?php esc_attr_e( 'Log in', 'mst_bodleid' ); ?>"
         aria-label="<?php esc_attr_e( 'Log in', 'mst_bodleid' ); ?>"
         type="submit">

  <input class="login__remember-input" type="checkbox" name="remember" id="remember-me-check">
  <label class="login__remember-label" for="remember-me-check">
    <?php esc_html_e( 'Remember me', 'mst_bodleid' ); ?>
  </label>

  <a href="#" class="login__forgotten-password">
    <?php esc_html_e( 'Forgotten password?', 'mst_bodleid' ); ?>
  </a>
</form>
