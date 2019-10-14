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

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">


  <main class="main" id="content" role="main">
    <section class="order-received" id="order-received">
      <div class="container">
        <div class="row">
          <h1 class="primary-title order-received__title">
            <?php esc_html_e( 'Checkout', 'mst_bodleid' ); ?>
          </h1>

          <div class="order-received__content-wrap">
            <?php if ( $checkout->get_checkout_fields() ) : ?>

              <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

              <?php mst_bodleid_the_sign_up_form( 'checkout-page' ); ?>

              <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

            <?php endif; ?>

            <div class="order-received__products-info-column">
              <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

              <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
              <table class="order-received__product-info-table">
                <thead class="order-received__product-info-headlines">
                <tr>
                  <th class="order-received__product-headline order-received__product-headline-product">
                    <?php esc_html_e( 'Product', 'mst_bodleid' ); ?>
                  </th>
                  <th class="order-received__product-headline order-received__product-headline-quantity">
                    <?php esc_html_e( 'Amount', 'mst_bodleid' ); ?>
                  </th>
                  <th class="order-received__product-headline order-received__product-headline-price">
                    <?php esc_html_e( 'Total', 'mst_bodleid' ); ?>
                  </th>
                </tr>
                </thead>
                <tbody>

                <?php
                do_action( 'woocommerce_review_order_before_cart_contents' );

                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                  $_product = apply_filters(
                    'woocommerce_cart_item_product',
                    $cart_item['data'],
                    $cart_item,
                    $cart_item_key
                  );

                  if ( $_product && $_product->exists() &&
                    $cart_item['quantity'] > 0 &&
                    apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key )
                  ) {
                    ?>

                    <tr class="order-received__product-info-content">
                      <td data-label="Vara">
                        <p class="order-received__product-name">
                          <?php echo esc_html( $_product->get_name() ); ?>
                        </p>
                        <p class="order-received__product-model">
                          <?php echo esc_html( sprintf( '%s: %s', __( 'Model', 'mst_bodleid' ), $_product->get_sku() ) ); ?>
                        </p>
                      </td>
                      <td data-label="<?php esc_html_e( 'Amount', 'mst_bodleid' ); ?>"
                          class="order-received__product-quantity">
                        <?php echo esc_html( $cart_item['quantity'] ); ?>
                      </td>
                      <td data-label="<?php esc_html_e( 'Total', 'mst_bodleid' ); ?>"
                          class="order-received__product-price">
                        <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                      </td>
                    </tr>

                    <?php
                  }
                }

                do_action( 'woocommerce_review_order_after_cart_contents' );
                ?>

                </tbody>
              </table>

              <table class="order-received__total-price-table">
                <tbody>
                <tr class="order-received__total-price-table-row">
                  <td><?php esc_html_e( 'Price without VAT', 'mst_bodleid' ); ?></td>
                  <td><?php wc_cart_totals_order_total_html(); ?></td>
                </tr>
                <tr class="order-received__total-price-table-row">
                  <td><?php esc_html_e( 'Home delivery within Iceland', 'mst_bodleid' ); ?></td>
                  <td><?php echo wc_price( 0 ); ?></td>
                </tr>
<!--                <tr class="order-received__total-price-table-row">-->
<!--                  <td>VSK (24%):</td>-->
<!--                  <td>--><?php //echo wc_price( 326.19 * 0.24 ); ?><!--</td>-->
<!--                </tr>-->
                <tr class="order-received__total-price-table-row">
                  <td><?php esc_html_e( 'Total', 'mst_bodleid' ); ?></td>
                  <td class="order-received__total-price-sum">
                    <?php wc_cart_totals_order_total_html(); ?>
                  </td>
                </tr>
                </tbody>
              </table>

              <div class="order-received__continue-box">
                <div class="order-received__continue-img-box">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Valitor.png"
                       alt=""
                       class="order-received__continue-img">
                </div>
                <div class="order-received__continue-btn-box">
                  <a href="#" class="order-received__continue-btn">Halda áfram</a>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<style>
  #order_review {
    display: none;
  }
</style>

<script>
  jQuery('.order-received__continue-btn').click(function() {
    jQuery('#place_order').click();
  });
</script>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
