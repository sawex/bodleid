<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

$post_thumbnail_id = $product->get_image_id();

//new WC_Product;

/* @var string $image_url */
$image_url = esc_url( wp_get_attachment_image_src( $post_thumbnail_id, 'full' )[0] );

//var_dump( wp_get_attachment_image_src( $post_thumbnail_id ) );
?>
<div id="product-<?php the_ID(); ?>" class="one-product">
  <div class="container">
    <div class="row">
      <?php
      /**
       * Hook: woocommerce_before_single_product_summary.
       *
       * @hooked woocommerce_show_product_sale_flash - 10
       * @hooked woocommerce_show_product_images - 20
       */
      do_action( 'woocommerce_before_single_product_summary' );
      ?>
      <div class="one-product__container">
        <div class="one-product__image-box">
          <a href="<?php echo $image_url; ?>" class="one-product__open-img">
            <img src="<?php echo $image_url; ?>"
                 alt="camera"
                 class="one-product__image">
          </a>
        </div>

        <div class="one-product__product-info">
          <div class="one-product__product-desc-box">
            <p class="one-product__product-model">Vörunúmer: <?php echo $product->get_sku(); ?></p>

            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_sharing - 50
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            do_action( 'woocommerce_single_product_summary' );
            ?>
          </div>

          <div class="one-product__price-and-status">
            <div class="one-product__product-price-box">
              <p class="one-product__product-price"><?php echo $product->get_price_html(); ?></p>
<!--              <p class="one-product__no-vat">án/vsk: 21.120kr</p>-->
            </div>
            <?php if ( $product->is_in_stock() ) { ?>
            <div class="one-product__product-status">
              <p>Til á lager</p>
            </div>
            <?php } ?>
          </div>

          <div class="one-product__order">
            <form action="#" method="POST" class="one-product__form">
              <button class="one-product__btn one-product__btn--plus">+</button>
              <input type="number" class="one-product__input" step="1" min="1" name="quantity" value="1">
              <button class="one-product__btn one-product__btn--minus one-product__btn--inactive">-</button>
            </form>
            <a href="" class="one-product__to-cart-btn">Bæta við í körfu</a>
          </div>

          <ul class="one-product__nav-menu">
            <li class="one-product__nav-item">
              <a href="#" class="one-product__nav-link one-product__compare-link">Samanburður</a>
            </li>
            <li class="one-product__nav-item">
              <a href="#" class="one-product__nav-link one-product__share-link">Deila</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="one-product__product-detail-container">
        <div class="one-product__detail-title-box">
          <h3 class="tertiary-title one-product__detail-title">Vörulýsing</h3>
        </div>
        <div class="one-product__detail">
          <?php echo $product->get_description(); ?>
        </div>
      </div>
    </div>

<!--    <div class="row">-->
<!--      <div class="one-product__related-prod-container">-->
<!--        <div class="one-product__detail-title-box">-->
<!--          <h3 class="tertiary-title one-product__related-title">Skyldar vörur</h3>-->
<!--        </div>-->
<!---->
<!--        <div class="one-product__related-products">-->
<!--          <ul class="product-menu">-->
<!--            <li class="product-item">-->
<!--              <a href="#" class="product-link">-->
<!--                <div class="product-img-box">-->
<!--                  <img src="assets/images/product-img.png" alt="#" class="product-img">-->
<!--                </div>-->
<!---->
<!--                <div class="product-info">-->
<!--                  <h4>Yealink RT10</h4>-->
<!--                  <p>Yealink RT10 Repeater er hægt að nota þar sem þörf er á því auka drægni á þráðlausum símum…</p>-->
<!--                </div>-->
<!---->
<!--                <div class="product-price">-->
<!--                  <p>26.189kr <span>án/vsk: 21.120kr</span></p>-->
<!--                  <button class="compare-btn"></button>-->
<!--                </div>-->
<!---->
<!--              </a>-->
<!--              <div class="to-cart-box">-->
<!--                <a href="#" class="add-to-catr-bnt">Setja í körfu</a>-->
<!--              </div>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->


  </div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>
<?php do_action( 'woocommerce_after_single_product' ); ?>
