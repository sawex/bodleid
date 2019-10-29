<?php
/**
 * Template part for displaying lost password form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 * @since 1.0.0
 */

?>

<form class="restore-password-form login__form login__form--restore-password">
  <h3 class="tertiary-title restore-password-form__title login__title login__title--active">
    <?php esc_html_e( 'Restore password', 'mst_bodleid' ); ?>
  </h3>

  <div class="form__input-box">
    <input class="form__input" type="email" name="restore-email" id="restore-email-field">
    <label class="form__label" for="restore-email-field">
      <?php esc_html_e( 'Email*', 'mst_bodleid' ); ?>
    </label>
  </div>

  <?php wp_nonce_field( 'restore-password','restore_password_nonce' ); ?>

  <input type="submit"
         value="<?php esc_attr_e( 'Submit', 'mst_bodleid' ); ?>"
         class="restore-password-form__submit-btn">
</form>