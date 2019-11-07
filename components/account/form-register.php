<?php
/**
 * Template part for displaying account form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 * @since 1.0.0
 */

/* @var string $sign_up_text */
$sign_up_text = wp_kses_post( get_field('account', 'option')['sign_up_text'] );
?>

<form class="login__form login__new-client login__new-client--signup collapsed">

  <h3 class="tertiary-title login__title">
    <?php esc_html_e( 'New customer', 'mst_bodleid' ); ?>
  </h3>

  <div class="login__animated-wrap">
    <p class="text login__text"><?php echo $sign_up_text; ?></p>

    <div class="login__new-client-wrap">
      <div class="login__personal-info">
        <h4 class="login__form-subtitle">
          <?php esc_html_e( 'Personal information', 'mst_bodleid' ); ?>
        </h4>

        <div class="form__input-box">
          <input class="form__input"
                 type="text"
                 name="billing_first_name"
                 id="name-field">
          <label class="form__label" for="name-field">
            <?php esc_html_e( 'First Name*', 'mst_bodleid' ); ?>
          </label>
        </div>

        <div class="form__input-box">
          <input class="form__input"
                 type="email"
                 name="billing_email"
                 id="email-field">
          <label class="form__label" for="email-field">
            <?php esc_html_e( 'Email*', 'mst_bodleid' ); ?>
          </label>
        </div>

        <div class="form__input-box">
          <input class="form__input"
                 type="tel"
                 name="billing_phone"
                 id="phone-field">
          <label class="form__label" for="phone-field">
            <?php esc_html_e( 'Phone number*', 'mst_bodleid' ); ?>
          </label>
        </div>

        <div class="form__input-box">
          <input class="form__input"
                 type="text"
                 name="billing_ssn"
                 id="ssn-field">
          <label class="form__label" for="ssn-field">
            <?php esc_html_e( 'SSN', 'mst_bodleid' ); ?>*
          </label>
        </div>

        <div class="form__input-box">
          <input class="form__input"
                 type="password"
                 name="password"
                 id="password-field">
          <label class="form__label" for="password-field">
            <?php esc_html_e( 'Password*', 'mst_bodleid' ); ?>
          </label>
        </div>
      </div>

      <div class="login__address-info">
        <h4 class="login__form-subtitle">
          <?php esc_html_e( 'Your address', 'mst_bodleid' ); ?>
        </h4>

        <div class="form__input-box">
          <input class="form__input"
                 type="text"
                 name="billing_company"
                 id="company-field">
          <label class="form__label" for="company-field">
            <?php esc_html_e( 'Company', 'mst_bodleid' ); ?>
          </label>
        </div>

        <div class="form__input-box">
          <input class="form__input"
                 type="text"
                 name="billing_address_1"
                 id="address-field">
          <label class="form__label" for="address-field">
            <?php esc_html_e( 'Address*', 'mst_bodleid' ); ?>
          </label>
        </div>

        <div class="form__input-box">
          <input class="form__input"
                 type="text"
                 name="billing_city"
                 id="city-field">
          <label class="form__label" for="city-field">
            <?php esc_html_e( 'City / Town*', 'mst_bodleid' ); ?>
          </label>
        </div>

        <div class="form__input-box">
          <input class="form__input"
                 type="text"
                 name="billing_postcode"
                 id="post-number-field">
          <label class="form__label" for="post-number-field">
            <?php esc_html_e( 'Post number*', 'mst_bodleid' ); ?>
          </label>
        </div>
      </div>
    </div>

    <?php wp_nonce_field( 'sign_up','sign_up_nonce' ); ?>

    <input class="login__form-btn"
           type="submit"
           value="<?php esc_attr_e( 'Register', 'mst_bodleid' ); ?>"
           aria-label="<?php esc_attr_e( 'Register', 'mst_bodleid' ); ?>">
  </div>
</form>

<style>
  .page-template-tmp-login .login__new-client--signup {
    height: 43em;
  }

  @media screen and (max-width: 529px) {
    .page-template-tmp-login .login__new-client--signup {
      height: 73em;
    }
  }
</style>