<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">
  <?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

  <div class="login__form login__new-client login__new-client--checkout">
    <h3 class="tertiary-title login__title login__title--active">
      <?php
        if ( is_user_logged_in() ) {
          esc_html_e( 'Customer data', 'mst_bodleid' );
        } else {
          esc_html_e( 'New customer', 'mst_bodleid' );
        }
      ?>
    </h3>

    <?php
    $fields = $checkout->get_checkout_fields( 'billing' );

    $left_fields = [
      'billing_first_name',
      'billing_last_name',
      'billing_last_name',
      'billing_phone',
      'billing_email',
    ];
?>
    <div class="login__new-client-wrap">
      <div class="login__personal-info">
        <h4 class="login__form-subtitle">
          <?php esc_html_e( 'Personal information', 'mst_bodleid' ); ?>
        </h4>
        <?php foreach ( $fields as $key => $field ) {
            if ( in_array( $key, $left_fields ) ) { ?>
          <div class="form__input-box">
            <?php
              $field['label_class'] = 'form__label';
              $field['input_class'][0] = 'form__input';
              woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
            ?>
          </div>
        <?php
            }
          }
        ?>

        <div class="form__input-box">
          <?php
            woocommerce_form_field(
              'billing_ssn', [
                'type' => 'text',
                'class' => ['form-row-wide'],
                'required' => true,
                'input_class' => ['form__input', 'input-text'],
                'label_class' => 'form__label',
                'label' => __( 'SSN', 'mst_bodleid' ),
              ],
              $checkout->get_value( 'billing_ssn' )
            );
          ?>
        </div>

        <?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
          <div class="woocommerce-account-fields">
            <?php if ( ! $checkout->is_registration_required() ) : ?>

              <div class="form__create-user-box form-row form-row-wide create-account">
                <input class="login__create-user-input" type="checkbox" name="createaccount" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> value="1" style="display: block;">
                <label class="login__create-user-label" for="createaccount">
                  <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
                </label>
              </div>

            <?php endif; ?>

            <?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

            <?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

              <div class="create-account">
                <div class="form__input-box">
                  <?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
                    <?php
                    $field['label_class'] = 'form__label';
                    $field['input_class'][0] = 'form__input';

                    woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                    ?>
                  <?php endforeach; ?>
                </div>
              </div>

            <?php endif; ?>

            <?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="login__address-info">
        <h4 class="login__form-subtitle">
          <?php esc_html_e( 'Your address', 'mst_bodleid' ); ?>
        </h4>

        <?php foreach ( $fields as $key => $field ) {
          if ( ! in_array( $key, $left_fields ) ) { ?>
            <div class="form__input-box" <?php echo $key === 'billing_country' ? 'style="display: none"' : ''; ?>>
              <?php
                $field['label_class'] = 'form__label';
                $field['input_class'][0] = 'form__input';

                woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
              ?>
            </div>
            <?php
          }
        }
        ?>
      </div>
    </div>
  </div>

  <?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>