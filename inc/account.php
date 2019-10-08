<?php
/**
 * User account helpers
 *
 * @link https://codex.wordpress.org/AJAX
 *
 * @package Bodleid
 */

if ( !function_exists( 'mst_bodleid_the_sign_up_form' ) ) {
  /**
   * Returns different registration forms depends on parameter
   *
   * @param string $type Type of sign up form
   *
   * @return void;
   */
  function mst_bodleid_the_sign_up_form( $type ) {
    echo mst_bodleid_get_sign_up_form( $type );
  }
}

if ( !function_exists( 'mst_bodleid_get_sign_up_form' ) ) {
  /**
   * Returns different registration forms depends on parameter
   *
   * @param string $type Type of sign up form
   *
   * @return string
   */
  function mst_bodleid_get_sign_up_form( $type = 'registration-page' ) {

    /* @var string|null $registration_form_text */
    $registration_form_text = get_field( 'registration_form_text', 'option' );
//
//    if ( $type === 'registration-page' ) {
//
//    } else if ( $type === 'checkout-page' ) {
//
//    } else if ( $type === 'account-page' ) {
//
//    }

    ?>

    <form class="login__form login__new-client">

      <?php if ( $type === 'registration-page' || $type === 'checkout-page' ) { ?>
        <h3 class="tertiary-title login__title">
          <?php esc_html_e( 'New customer', 'mst_bodleid' ); ?>
        </h3>

        <p class="text login__text"><?php wp_kses_post( $registration_form_text ); ?></p>
      <?php } ?>

      <?php if ( $type === 'account-page' ) { ?>
        <h3 class="tertiary-title login__title">
          <?php esc_html_e( 'Update data', 'mst_bodleid' ); ?>
        </h3>
      <?php } ?>

      <div class="login__new-client-wrap">
        <div class="login__personal-info">
          <h4 class="login__form-subtitle">
            <?php esc_html_e( 'Personal information', 'mst_bodleid' ); ?>
          </h4>

          <div class="form__input-box">
            <input class="form__input" type="text" name="name" id="name-field">
            <label class="form__label" for="name-field">
              <?php esc_html_e( 'First Name*', 'mst_bodleid' ); ?>
            </label>
          </div>

          <div class="form__input-box">
            <input class="form__input" type="text" name="extensions" id="extensions-field">
            <label class="form__label" for="extensions-field">
              <?php esc_html_e( 'Extensions', 'mst_bodleid' ); ?>
            </label>
          </div>

          <div class="form__input-box">
            <input class="form__input" type="email" name="email" id="email-field">
            <label class="form__label" for="email-field">
              <?php esc_html_e( 'Email*', 'mst_bodleid' ); ?>
            </label>
          </div>

          <div class="form__input-box">
            <input class="form__input" type="tel" name="phone" id="phone-field">
            <label class="form__label" for="phone-field">
              <?php esc_html_e( 'Phone number*', 'mst_bodleid' ); ?>
            </label>
          </div>

          <div class="form__input-box">
            <input class="form__input" type="password" name="password" id="password-field">
            <label class="form__label" for="password-field">
              <?php esc_html_e( 'Create a password*', 'mst_bodleid' ); ?>
            </label>
          </div>
        </div>

        <div class="login__address-info">
          <h4 class="login__form-subtitle">
            <?php esc_html_e( 'Your address', 'mst_bodleid' ); ?>
          </h4>

          <div class="form__input-box">
            <input class="form__input" type="text" name="company" id="company-field">
            <label class="form__label" for="company-field">
              <?php esc_html_e( 'Company', 'mst_bodleid' ); ?>
            </label>
          </div>

          <div class="form__input-box">
            <input class="form__input" type="text" name="address" id="address-field">
            <label class="form__label" for="address-field">
              <?php esc_html_e( 'Address*', 'mst_bodleid' ); ?>
            </label>
          </div>

          <div class="form__input-box">
            <input class="form__input" type="text" name="city" id="city-field">
            <label class="form__label" for="city-field">
              <?php esc_html_e( 'City / Town*', 'mst_bodleid' ); ?>
            </label>
          </div>

          <div class="form__input-box">
            <input class="form__input" type="text" name="post-number" id="post-number-field">
            <label class="form__label" for="post-number-field">
              <?php esc_html_e( 'Post number*', 'mst_bodleid' ); ?>
            </label>
          </div>

          <div class="form__input-box">
            <input class="form__input" type="text" name="country" id="country-field">
            <label class="form__label" for="country-field">
              <?php esc_html_e( 'Country*', 'mst_bodleid' ); ?>
            </label>
          </div>

          <div class="form__input-box form__select-box">
            <select class="form__input" name="region" id="region-field">
              <option>Höfuðborgarsvæðið</option>
              <option>Suðurnes</option>
              <option>Vesturland</option>
              <option>Vestfirðir</option>
              <option>Norðurland vestra</option>
              <option>Norðurland eystra</option>
              <option>Austurland</option>
              <option>Suðurland</option>
            </select>
            <label class="form__label" for="region-field">
              <?php esc_html_e( 'Region*', 'mst_bodleid' ); ?>
            </label>
          </div>
        </div>
      </div>

      <input class="login__form-btn"
             type="submit"
             value="<?php esc_attr_e( 'Register', 'mst_bodleid' ); ?>"
             aria-label="<?php esc_attr_e( 'Register', 'mst_bodleid' ); ?>">
    </form>

    <?php
  }
}
