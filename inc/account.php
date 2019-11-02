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
   * @param bool $is_collapsed Return opened or collapsed.
   * @param bool $show_desc_text Return desc text or without it.
   * @param string $redirect_url URL to redirect after successful submit.
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

        <a href="<?php echo mst_bodleid_lostpassword_url(); ?>" class="login__forgotten-password">
          <?php esc_html_e( 'Forgotten password?', 'mst_bodleid' ); ?>
        </a>
      </div>
    </form>
  <?php
  }
}

if ( ! function_exists( 'mst_bodleid_add_forgot_password_class' ) ) {
  /**
   * Add page-forgot-password class to the forgot password page
   *
   * @param array $classes HTML <body> classes
   * @return array Updated classes
   */
  function mst_bodleid_add_forgot_password_class( $classes ) {
    if ( is_page_template( 'tmp-forgot-password.php' ) ) {
      $classes[] = 'page-forgot-password';
    }

    return $classes;
  }
}

add_filter( 'body_class', 'mst_bodleid_add_forgot_password_class' );

if ( ! function_exists( 'mst_bodleid_lostpassword_url' ) ) {
  /**
   * @return string Lost password page url.
   * */
  function mst_bodleid_lostpassword_url() {
    return esc_url( get_permalink( get_page_by_path( 'restore-password' ) ) );
  }
}

if ( ! function_exists( 'mst_bodleid_get_account_page' ) ) {
  /**
   * @return string Account page url
   * */
  function mst_bodleid_get_account_page() {
    return esc_url( get_permalink( get_page_by_path( 'account' ) ) );
  }
}

if ( ! function_exists( 'mst_bodleid_get_login_page' ) ) {
  /**
   * @return string Login page url
   * */
  function mst_bodleid_get_login_page() {
    return esc_url( get_permalink( get_page_by_path( 'login' ) ) );
  }
}

if ( ! function_exists( 'mst_bodleid_get_forgot_password_url_email_template' ) ) {
  /**
   * Returns forgot password email template with recovery URL.
   *
   * @param string $user_login
   * @param string $url Recovery URL
   *
   * @return string Email template
   * */
  function mst_bodleid_get_forgot_password_url_email_template( $user_login, $url ) {
    /* @var string $site_name */
    $site_name = get_bloginfo( 'name' );

    return <<<MSG
  <p>Einhver hefur óskað eftir nýju lykilorði fyrir eftirfarandi aðgang:</p>

  <p>Site Name: <b>$site_name</b></p>
  
  <p>Notandanafn: <b>$user_login</b></p>
  
  <p>Ef þetta voru mistök þá er þér óhætt að hundsa þennan póst og ekkert verður aðhafst.</p>
  
  <p>Til að endursetja lykilorð þarftu að heimsækja eftirfarandi veffang:</p>
  
  <a href="$url">$url</a>
MSG;
  }
}