<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div class="one-product__price-and-status">
  <div class="one-product__product-price-box">
    <p class="one-product__product-price <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) );?>">
      <?php echo $product->get_price_html(); ?>
    </p>
    <!--              <p class="one-product__no-vat">án/vsk: 21.120kr</p>-->
  </div>
  <?php if ( $product->is_in_stock() ) { ?>
    <div class="one-product__product-status">
      <p><?php esc_html_e( 'In stock', 'mst_bodleid' ); ?></p>
    </div>
  <?php } ?>
</div>
