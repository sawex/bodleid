<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
?>
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
      $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

      if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
        /* @var string $title */
        $title = esc_html( $_product->get_name() );

        /* @var string $permalink */
        $permalink = esc_url( $_product->get_permalink() );

        /* @var string $sku */
        $sku = esc_html( sprintf( '%s: %s', __( 'Model', 'mst_bodleid' ), $_product->get_sku() ) );

        /* @var string $quantity */
        $quantity = esc_html( $cart_item['quantity'] );

        /* @var string $total */
        $total = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
        ?>
        <tr class="order-received__product-info-content">
          <td data-label="<?php esc_attr_e( 'Product', 'mst_bodleid' ); ?>">
            <p class="order-received__product-name">
              <a href="<?php echo $permalink; ?>"><?php echo $title; ?></a>
            </p>
            <p class="order-received__product-model">
              <?php echo $sku; ?>
            </p>
          </td>

          <td data-label="<?php esc_attr_e( 'Amount', 'mst_bodleid' ); ?>"
              class="order-received__product-quantity">
            <?php echo $quantity; ?>
          </td>

          <td data-label="<?php esc_attr_e( 'Total', 'mst_bodleid' ); ?>"
              class="order-received__product-price">
            <?php echo $total; ?>
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
      <td><?php esc_html_e( 'Price without VAT:', 'mst_bodleid' ); ?></td>
      <td><?php echo WC()->cart->get_total_ex_tax(); ?></td>
    </tr>
    <tr class="order-received__total-price-table-row">
      <td><?php esc_html_e( 'Home delivery within Iceland:', 'mst_bodleid' ); ?></td>
      <td><?php echo WC()->cart->get_cart_shipping_total(); ?></td>
    </tr>
    <tr class="order-received__total-price-table-row">
      <td><?php esc_html_e( 'VAT (24%):', 'mst_bodleid' ); ?></td>
      <td><?php wc_cart_totals_taxes_total_html(); ?></td>
    </tr>
    <tr class="order-received__total-price-table-row">
      <td><?php esc_html_e( 'Total:', 'mst_bodleid' ); ?></td>
      <td class="order-received__total-price-sum">
        <?php echo WC()->cart->get_cart_total(); ?>
      </td>
    </tr>
    </tbody>
  </table>

    <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

      <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
      <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

    <?php endif; ?>

    <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

    <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>