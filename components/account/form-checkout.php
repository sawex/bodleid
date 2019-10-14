<?php
/**
 * Template part for displaying checkout form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 * @since 1.0.0
 */

$user_id = get_current_user_id();

$first_name = '';
$last_name = '';
$address = '';
$city = '';
$company = '';
$email = '';
$phone = '';
$zip = '';
$region = '';

if ( $user_id ) {
  $first_name = esc_attr( get_user_meta( $user_id, 'billing_first_name', true ) );
  $last_name = esc_attr( get_user_meta( $user_id, 'billing_last_name', true ) );
  $address = esc_attr( get_user_meta( $user_id, 'billing_address_1', true ) );
  $city = esc_attr( get_user_meta( $user_id, 'billing_city', true ) );
  $company = esc_attr( get_user_meta( $user_id, 'billing_company', true ) );
  $email = esc_attr( get_user_meta( $user_id, 'billing_email', true ) );
  $phone = esc_attr( get_user_meta( $user_id, 'billing_phone', true ) );
  $zip = esc_attr( get_user_meta( $user_id, 'billing_postcode', true ) );
  $region = esc_attr( get_user_meta( $user_id, 'billing_state', true ) );
}
?>

<div class="login__form login__new-client">

  <h3 class="tertiary-title login__title">
    <?php
      if ( $user_id ) {
        esc_html_e( 'Customer data', 'mst_bodleid' );
      } else {
        esc_html_e( 'New customer', 'mst_bodleid' );
      }
    ?>
  </h3>

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
               type="text"
               name="billing_last_name"
               id="extensions-field"
               value="<?php echo $last_name; ?>">
        <label class="form__label" for="extensions-field">
          <?php esc_html_e( 'Last Name', 'mst_bodleid' ); ?>
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

      <div class="form__input-box form__select-box">
        <select class="form__input"
                name="region"
                id="region-field"
                value="<?php echo $region; ?>">
          <option><?php esc_html_e( 'Capital Region', 'mst_bodleid' ); ?></option>
          <option><?php esc_html_e( 'Southern Peninsula', 'mst_bodleid' ); ?></option>
          <option><?php esc_html_e( 'Western Region', 'mst_bodleid' ); ?></option>
          <option><?php esc_html_e( 'Westfjords', 'mst_bodleid' ); ?></option>
          <option><?php esc_html_e( 'Northwestern Region', 'mst_bodleid' ); ?></option>
          <option><?php esc_html_e( 'Northeastern Region', 'mst_bodleid' ); ?></option>
          <option><?php esc_html_e( 'Eastern Region', 'mst_bodleid' ); ?></option>
          <option><?php esc_html_e( 'Southern Region', 'mst_bodleid' ); ?></option>
        </select>
        <label class="form__label" for="region-field">
          <?php esc_html_e( 'Region*', 'mst_bodleid' ); ?>
        </label>
      </div>
    </div>
  </div>
</div>
