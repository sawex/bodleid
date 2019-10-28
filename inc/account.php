<?php
/**
 * User account helpers
 *
 * @link https://codex.wordpress.org/AJAX
 *
 * @package Bodleid
 */

if ( ! function_exists( 'mst_bodleid_the_sign_up_form' ) ) {
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
      default:
        get_template_part( 'components/account/form', 'register' );
    }
  }
}

if ( ! function_exists( 'mst_bodleid_the_login_form' ) ) {
  /**
   * Returns login form
   *
   * @return void
   */
  function mst_bodleid_the_login_form( $is_collapsed = false, $show_desc_text = true, $redirect_url ) {
    /* @var string $login_text */
    $login_text = wp_kses_post( get_field( 'account', 'option' )['login_text'] );
    ?>

    <form class="login__form login__form--login <?php echo $is_collapsed ? 'collapsed' : ''; ?>"
          data-redirect="<?php echo esc_url( $redirect_url ); ?>">

      <h3 class="tertiary-title login__title <?php echo ! $is_collapsed ? 'login__title--active' : ''; ?>">
        <?php esc_html_e( 'Log in', 'mst_bodleid' ); ?>
      </h3>

      <div class="login__animated-wrap">
        <?php if ( $show_desc_text ) { ?>
          <p class="text login__text">
            <?php echo $login_text; ?>
          </p>
        <?php } ?>

          <div class="login__input-wrap">
          <div class="form__input-box">
            <input class="form__input" type="text" name="email" id="login-email-field">
            <label class="form__label" for="login-email-field">
              <?php esc_html_e( 'Email*', 'mst_bodleid' ); ?>
            </label>
          </div>

          <div class="form__input-box">
            <input class="form__input" type="password" name="user_password" id="login-password-field">
            <label class="form__label" for="login-password-field">
              <?php esc_html_e( 'Password*', 'mst_bodleid' ); ?>
            </label>
          </div>
        </div>

        <?php wp_nonce_field( 'login','login_nonce' ); ?>

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
      </div>
    </form>
  <?php
  }

}

