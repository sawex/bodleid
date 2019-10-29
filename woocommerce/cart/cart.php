<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<section class="breadcrumbs">
  <div class="container">
    <div class="row">
      <?php get_template_part( 'components/page/content', 'breadcrumbs' ); ?>
    </div>
  </div>
</section>

<section class="cart" id="cart">

  <div class="container">
    <div class="row">
      <div class="woocommerce-notices-wrapper woocommerce-notices-wrapper--cart">
        <?php
        /**
         * Hook: mst_bodleid_wc_notices.
         *
         * @hooked wc_print_notices - 10
         */
        do_action( 'mst_bodleid_wc_notices' );
        ?>
      </div>
    </div>

    <div class="row">
      <div class="cart__orders-list-container">
        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

          <?php do_action( 'woocommerce_before_cart_table' ); ?>

          <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
            <thead>
              <tr>
                <th class="product-remove cart-title"><?php esc_html_e( 'Cart', 'woocommerce' ); ?></th>
                <th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                <th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
                <th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                <th class="product-subtotal"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
                <th class="product-thumbnail">&nbsp;</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <td class="shipping" colspan="2">
                  <?php
                    /* @var array $available_methods */
                    $available_methods = WC()->shipping->packages[0]['rates'];

                    /* @var string $chosen_method */
                    $chosen_method = WC()->session->get( 'chosen_shipping_methods' )[0];

                    if ( $available_methods ) {
                      ?>
                      <h3 class="shipping__title">
                        <?php esc_html_e( 'Shipping', 'woocommerce' ); ?>
                      </h3>

                      <ul id="shipping_method" class="woocommerce-shipping-methods">
                        <?php foreach ( $available_methods as $index => $method ) { ?>
                          <li>
                            <?php
                            if ( 1 < count( $available_methods ) ) {
                              printf('<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr(sanitize_title($method->id)), esc_attr($method->id), checked($method->id, $chosen_method, false)); // WPCS: XSS ok.
                            } else {
                              printf('<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr(sanitize_title($method->id)), esc_attr($method->id), checked($method->id, $chosen_method, false)); // WPCS: XSS ok.
                            }

                            printf('<label for="shipping_method_%1$d_%2$s">%3$s</label>', $index, esc_attr(sanitize_title($method->id)), wc_cart_totals_shipping_method_label($method)); // WPCS: XSS ok.

                            do_action( 'woocommerce_after_shipping_rate', $method, $index );
                            ?>
                          </li>
                        <?php } ?>
                      </ul>
                    <?php } ?>
                </td>
                <td colspan="4" class="actions">
                  <button type="submit"
                          class="button"
                          name="update_cart"
                          value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
                    <?php esc_html_e( 'Update cart', 'woocommerce' ); ?>
                  </button>

                  <?php if ( wc_coupons_enabled() ) { ?>
                    <div class="coupon form__input-box">
                      <input type="text"
                             name="coupon_code"
                             class="input-text form__input"
                             id="coupon_code"
                             value=""
                             placeholder="" />

                      <label for="coupon_code" class="form__label">
                        <?php esc_html_e( 'Coupon:', 'woocommerce' ); ?>
                      </label>

                      <button type="submit"
                              class="button"
                              name="apply_coupon"
                              value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
                        <?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>
                      </button>
                      <?php do_action( 'woocommerce_cart_coupon' ); ?>
                    </div>
                  <?php } ?>

                  <?php do_action( 'woocommerce_cart_actions' ); ?>

                  <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

                  <div class="total">
                    <div class="total__text-box">
                      <p class="total__title"><?php esc_html_e( 'Total', 'woocommerce' ); ?></p>
                      <p class="total__sum"><?php echo WC()->cart->get_total(); ?></p>
                    </div>
                    <div class="wc-proceed-to-checkout">
                      <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>"
                         class="checkout-button button alt wc-forward">
                        <?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?>
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
            </tfoot>

            <tbody>
              <?php do_action( 'woocommerce_before_cart_contents' ); ?>

              <?php
                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                 $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                 $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                  if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
              ?>

              <tr class="woocommerce-cart-form__cart-item cart_item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                <td class="product-thumbnail" data-title="<?php esc_attr_e( 'Cart', 'woocommerce' ); ?>">
                  <?php
                  $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                  if ( ! $product_permalink ) {
                    echo $thumbnail; // PHPCS: XSS ok.
                  } else {
                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                  }
                  ?>
                </td>

                <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                  <?php
                    if ( ! $product_permalink ) {
                      echo wp_kses_post(apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                    } else {
                      echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                    }

                    do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                    // Meta data.
                    echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                    // Backorder notification.
                    if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                      echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                    }
                  ?>

                  <span class="product-model">
                    <?php
                     echo esc_html( sprintf( '%s: %s', __( 'Model', 'mst_bodleid' ), $_product->get_sku() ) );
                     ?>
                  </span>
                </td>

                <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                  <?php
                    echo apply_filters(
                      'woocommerce_cart_item_price',
                      WC()->cart->get_product_price( $_product ),
                      $cart_item,
                      $cart_item_key
                    ); // PHPCS: XSS ok.
                  ?>
                </td>

                <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                  <div class="quantity">
                    <button class="one-product__btn one-product__btn--minus">-</button>

                    <?php
                    if ( $_product->is_sold_individually() ) {
                      $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                    } else {
                      $product_quantity = woocommerce_quantity_input(
                        array(
                          'input_name'   => "cart[{$cart_item_key}][qty]",
                          'input_value'  => $cart_item['quantity'],
                          'max_value'    => $_product->get_max_purchase_quantity(),
                          'min_value'    => '0',
                          'product_name' => $_product->get_name(),
                          'classes'      => 'input-text qty text one-product__input'
                        ),
                        $_product,
                        false
                      );
                    }

                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                    ?>
                    <button class="one-product__btn one-product__btn--plus">+</button>
                  </div>
                </td>

                <td class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
                  <?php
                    echo apply_filters(
                      'woocommerce_cart_item_subtotal',
                      WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ),
                      $cart_item,
                      $cart_item_key
                    ); // PHPCS: XSS ok.
                  ?>
                </td>

                <td class="product-remove">
                  <?php
                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                      'woocommerce_cart_item_remove_link',
                      sprintf(
                        '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                        esc_html__( 'Remove this item', 'woocommerce' ),
                        esc_attr( $product_id ),
                        esc_attr( $_product->get_sku() )
                      ),
                      $cart_item_key
                    );
                  ?>
                </td>

              </tr>
              <?php
                }
              }
              ?>

              <?php do_action( 'woocommerce_after_cart_contents' ); ?>
            </tbody>
          </table>
          <?php do_action( 'woocommerce_after_cart_table' ); ?>
        </form>

        <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
      </div>
    </div>
  </div>
</section>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
  <?php
  /**
   * Cart collaterals hook.
   */
  do_action( 'woocommerce_cart_collaterals' );
  ?>
</div>