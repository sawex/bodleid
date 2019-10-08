<?php
/**
 * Template part for displaying footer contact form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 */
?>

<form class="form">
  <div class="form__input-box">
    <input class="form__input" type="text" name="name" id="name-field">
    <label class="form__label" for="name-field">
      <?php esc_html_e( 'Name', 'mst_bodleid' ); ?>
    </label>
  </div>

  <div class="form__input-box">
    <input class="form__input" type="tel" name="phone" id="phone-field">
    <label class="form__label" for="phone-field">
      <?php esc_html_e( 'Phone number', 'mst_bodleid' ); ?>
    </label>
  </div>

  <div class="form__input-box">
    <input class="form__input" type="text" name="email" id="email-field">
    <label class="form__label" for="email-field">
      <?php esc_html_e( 'Email', 'mst_bodleid' ); ?>
    </label>
  </div>

  <div class="form__input-box">
    <input class="form__input" type="text" name="company" id="company-field">
    <label class="form__label" for="company-field">
      <?php esc_html_e( 'Company', 'mst_bodleid' ); ?>
    </label>
  </div>

  <div class="form__input-box form__input-box--textarea">
    <textarea class="form__message form__input" name="message" id="message-field"></textarea>
    <label class="form__label" for="message-field">
      <?php esc_html_e( 'Message', 'mst_bodleid' ); ?>
    </label>
  </div>

  <div class="form__error">
    <p><?php esc_html_e( 'Please fill in the selected fields.', 'mst_bodleid' ); ?></p>
  </div>

  <input class="form__submit-btn"
         type="submit"
         value="<?php esc_attr_e( 'Send', 'mst_bodleid' ); ?>">
</form>

<div class="form__success hidden">
  <p><?php esc_html_e('Thank you, message received', 'mst_bodleid' ); ?></p>
</div>