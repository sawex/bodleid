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

/* @global WC_Product $product */
global $product;

/**
 * Hook: woocommerce_before_single_product.
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

/* @var int $post_thumbnail_id */
$post_thumbnail_id = $product->get_image_id();

/* @var array $post_gallery Gallery images ids */
$post_gallery = $product->get_gallery_image_ids();

/* @var string $image_url */
$image_url = esc_url( wp_get_attachment_image_src( $post_thumbnail_id, 'full' )[0] );

/* @var array $related */
$related = $product->get_cross_sell_ids();

/* @var array $additional_description */
$additional_description = get_field( 'additional_description' );

/* @var string $wp_placeholder_img */
$wp_placeholder_img = esc_url( wc_placeholder_img_src() );
?>

<div id="product-<?php the_ID(); ?>" class="one-product">
  <div class="container">
    <div class="row">
      <div class="woocommerce-notices-wrapper woocommerce-notices-wrapper--single">
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

          <?php if ( empty( $post_gallery ) ) { ?>
            <a class="one-product__open-img">
              <img src="<?php echo $image_url ?: $wp_placeholder_img; ?>"
                   alt="<?php echo $product->get_title(); ?>"
                   class="one-product__image">
            </a>
          <?php } else { ?>

            <a class="one-product__open-img">
              <?php
                foreach( $post_gallery as $image ) {
                /* @var string $src */
                $src = esc_url( wp_get_attachment_image_src( $image, 'full' )[0] );

                /* @var string $caption */
                $caption = esc_html( wp_get_attachment_caption( $image ) );
              ?>
              <img src="<?php echo $src; ?>"
                   alt="<?php echo $caption; ?>"
                   class="one-product__image">
              <?php } ?>
            </a>

            <ul class="one-product__product-gallery">
              <?php
                foreach( $post_gallery as $image ) {
                  /* @var string $src */
                  $src = esc_url( wp_get_attachment_image_src( $image )[0] );

                  /* @var string $caption */
                  $caption = esc_html( wp_get_attachment_caption( $image ) );
              ?>
                <li class="one-product__product-gallery-item">
                  <a class="one-product__product-gallery-link">
                    <img src="<?php echo $src; ?>"
                         alt="<?php echo $caption; ?>"
                         class="one-product__product-gallery-img">
                  </a>
                </li>
              <?php } ?>
            </ul>
          <?php } ?>
        </div>

        <div class="one-product__product-info">
          <div class="one-product__product-desc-box">
            <p class="one-product__product-model">
              <?php echo esc_html( sprintf( '%s: %s', __( 'Model', 'mst_bodleid' ), $product->get_sku() ) ); ?>
            </p>

            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_price - 25
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_sharing - 50
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            do_action( 'woocommerce_single_product_summary' );
            ?>
          </div>

          <ul class="one-product__nav-menu">
            <li class="one-product__nav-item">

              <?php if ( ! mst_bodleid_is_product_in_comparison_list( $product->get_id() ) ) { ?>
                <a class="one-product__nav-link one-product__compare-link"
                   data-id="<?php the_ID(); ?>">
                  <?php esc_html_e( 'Comparison', 'mst_bodleid' ); ?>
                </a>
              <?php } else { ?>
                <a class="one-product__nav-link one-product__compare-link"
                   data-id="<?php the_ID(); ?>"
                   href="<?php echo mst_bodleid_get_comparison_page_url(); ?>">
                  <?php esc_html_e( 'View comparison list', 'mst_bodleid' ); ?>
                </a>
              <?php } ?>

            </li>
            <li class="one-product__nav-item">
              <a href="<?php echo add_query_arg(
                    [ 'u' => $product->get_permalink() ],
                    'https://www.facebook.com/sharer.php'
                  );
                ?>"
                 class="one-product__nav-link one-product__share-link"
                 target="_blank">
                <?php esc_html_e( 'Share', 'mst_bodleid' ); ?>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <?php if ( ! empty( $product->get_description() ) || ! empty( $additional_description ) ) { ?>
      <div class="row">
        <div class="one-product__product-detail-container">
          <div class="one-product__detail-title-box">
            <h3 class="tertiary-title one-product__detail-title">
              <?php esc_html_e( 'Product description', 'woocommerce' ); ?>
            </h3>
          </div>
          <div class="one-product__details-container">
            <div class="one-product__detail">
              <p><?php echo $product->get_description(); ?></p>
            </div>

            <?php
              if ( ! empty( $additional_description ) ) {
                foreach ( $additional_description as $desc_item ) {
            ?>

               <div class="one-product__detail">
                 <p><?php echo wp_kses_post( $desc_item['text'] ); ?></p>
               </div>

            <?php
                }
              }
            ?>
          </div>
        </div>
      </div>
    <?php } ?>

    <?php if ( ! empty( $related ) && function_exists( 'mst_bodleid_the_product_html' ) ) { ?>
      <div class="row">
        <div class="col-md-12">
          <div class="one-product__related-prod-container">
            <div class="one-product__detail-title-box">
              <h3 class="tertiary-title one-product__related-title">
                <?php esc_html_e( 'Related products', 'mst_bodleid' ); ?>
              </h3>
            </div>

            <div class="one-product__related-products">
              <ul class="product-menu">
                <?php
                  foreach ( $related as $related_product ) {
                    mst_bodleid_the_product_html( $related_product );
                  }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
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
