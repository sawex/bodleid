<?php
/**
 * Template part for displaying account form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 * @since 1.0.0
 */

$user_id = get_current_user_id();

$first_name = '';
$address = '';
$city = '';
$company = '';
$email = '';
$phone = '';
$zip = '';

if ( $user_id ) {
  $first_name = esc_attr( get_user_meta( $user_id, 'billing_first_name', true ) );
  $address = esc_attr( get_user_meta( $user_id, 'billing_address_1', true ) );
  $city = esc_attr( get_user_meta( $user_id, 'billing_city', true ) );
  $company = esc_attr( get_user_meta( $user_id, 'billing_company', true ) );
  $email = esc_attr( get_user_meta( $user_id, 'billing_email', true ) );
  $phone = esc_attr( get_user_meta( $user_id, 'billing_phone', true ) );
  $zip = esc_attr( get_user_meta( $user_id, 'billing_postcode', true ) );
}
?>

<form class="login__form login__new-client login__new-client--account">

  <h3 class="tertiary-title login__title login__title--active">
    <?php esc_html_e( 'Update data', 'mst_bodleid' ); ?>
  </h3>

  <div class="login__animated-wrap">
    <div class="login__new-client-wrap">
      <div class="login__personal-info">
        <h4 class="login__form-subtitle">
          <?php esc_html_e( 'Personal information', 'mst_bodleid' ); ?>
        </h4>

        <div class="form__input-box">
          <input class="form__input"
                 type="text"
                 name="billing_first_name"
                 id="name-field"
                 value="<?php echo $first_name; ?>">
          <label class="form__label" for="name-field">
            <?php esc_html_e( 'First Name*', 'mst_bodleid' ); ?>
          </label>
        </div>

        <div class="form__input-box">
          <input class="form__input"
                 type="email"
                 name="billing_email"
                 id="email-field"
                 value="<?php echo $email; ?>">
          <label class="form__label" for="email-field">
            <?php esc_html_e( 'Email*', 'mst_bodleid' ); ?>
          </label>
        </div>

        <div class="form__input-box">
          <input class="form__input"
                 type="tel"
                 name="billing_phone"
                 id="phone-field"
                 value="<?php echo $phone; ?>">
          <label class="form__label" for="phone-field">
            <?php esc_html_e( 'Phone number*', 'mst_bodleid' ); ?>
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
                 id="company-field"
                 value="<?php echo $company; ?>">
          <label class="form__label" for="company-field">
            <?php esc_html_e( 'Company', 'mst_bodleid' ); ?>
          </label>
        </div>

        <div class="form__input-box">
          <input class="form__input"
                 type="text"
                 name="billing_address_1"
                 id="address-field"
                 value="<?php echo $address; ?>">
          <label class="form__label" for="address-field">
            <?php esc_html_e( 'Address*', 'mst_bodleid' ); ?>
          </label>
        </div>

        <div class="form__input-box">
          <input class="form__input"
                 type="text"
                 name="billing_city"
                 id="city-field"
                 value="<?php echo $city; ?>">
          <label class="form__label" for="city-field">
            <?php esc_html_e( 'City / Town*', 'mst_bodleid' ); ?>
          </label>
        </div>

        <div class="form__input-box">
          <input class="form__input"
                 type="text"
                 name="billing_postcode"
                 id="post-number-field"
                 value="<?php echo $zip; ?>">
          <label class="form__label" for="post-number-field">
            <?php esc_html_e( 'Post number*', 'mst_bodleid' ); ?>
          </label>
        </div>
      </div>
    </div>

    <?php wp_nonce_field( 'update_account_data','update_account_data_nonce' ); ?>

    <input class="login__form-btn"
           type="submit"
           value="<?php esc_attr_e( 'Update', 'mst_bodleid' ); ?>"
           aria-label="<?php esc_attr_e( 'Update', 'mst_bodleid' ); ?>">
  </div>
</form>
