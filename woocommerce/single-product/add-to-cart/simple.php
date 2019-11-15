<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

$product_cart_id = WC()->cart->generate_cart_id( $product->get_id() );

$in_cart = WC()->cart->find_product_in_cart( $product_cart_id );

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<div class="one-product__order">
	<form class="cart one-product__form"
        action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>"
        method="post"
        enctype='multipart/form-data'>

		<?php
    do_action( 'woocommerce_before_add_to_cart_button' );

    if ( ! $in_cart ) {
      do_action( 'woocommerce_before_add_to_cart_quantity' );

      woocommerce_quantity_input( array(
        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
        'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
        'classes'     => 'one-product__input',
      ) );

      do_action( 'woocommerce_after_add_to_cart_quantity' );
    ?>

      <button type="submit"
              name="add-to-cart"
              value="<?php echo esc_attr( $product->get_id() ); ?>"
              class="single_add_to_cart_button button alt one-product__to-cart-btn">
        <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
      </button>
    <?php } else { ?>
      <a href="<?php echo wc_get_cart_url(); ?>"
         name="add-to-cart"
         class="single_add_to_cart_button button alt one-product__to-cart-btn">
        <?php esc_html_e( 'View cart', 'woocommerce' ); ?>
      </a>

      <?php
      // Backorder notification.
      if ( $product->backorders_require_notification() && $product->is_on_backorder() ) {
        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
      }
      ?>
    <?php } ?>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>
</div>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>