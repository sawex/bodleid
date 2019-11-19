<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}
?>
<section class="order-received" id="order-received">
  <div class="container">
    <div class="row">
      <h1 class="primary-title order-received__title">
        <?php esc_html_e( 'Checkout', 'woocommerce' ); ?>
      </h1>
    </div>

    <div class="row">
      <div class="woocommerce-notices-wrapper woocommerce-notices-wrapper--checkout"></div>
    </div>

    <div class="row">
      <div class="order-received__forms-wrapper">
        <div class="order-received__forms-container">

          <?php if ( ! is_user_logged_in() ) { ?>
            <form class="login__form login__form--login-checkout-hidden"
                  data-redirect="<?php echo esc_url( wc_get_checkout_url() ); ?>"
                  id="checkout-login-form"
                  style="display: none;">
              <?php wp_nonce_field( 'login','login_nonce' ); ?>
            </form>
          <?php } ?>

          <form name="checkout"
                method="post"
                class="checkout woocommerce-checkout"
                action="<?php echo esc_url( wc_get_checkout_url() ); ?>"
                enctype="multipart/form-data">

            <div class="order-received__content-wrap">
              <div class="order-received__order-info-column">

                <?php
                  if ( ! is_user_logged_in() ) {
                    get_template_part( 'components/account/form', 'checkout-login-form' );
                  }
                ?>

                <?php if ( $checkout->get_checkout_fields() ) : ?>

                  <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                  <div id="customer_details">
                    <?php do_action( 'woocommerce_checkout_billing' ); ?>
                    <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                  </div>

                  <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                <?php endif; ?>

              </div>

            </div>

            <div class="order-received__products-info-column">

              <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

              <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

              <?php do_action( 'woocommerce_checkout_order_review' ); ?>

              <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
            </div>
          </form>

        </form>
      </div>
    </div>
  </div>
</section>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>