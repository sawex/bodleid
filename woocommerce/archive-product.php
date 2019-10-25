<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

if ( ! is_search() && is_shop() ) {
  get_template_part( 'components/page/content', 'banner-shop' );
}

/* @var array|stdClass $featured_products */
$featured_products = wc_get_products( [
  'featured' => true,
  'paginate' => false,
  'limit' => 6,
  ] );

/* @var array $catalogs_ids */
$catalogs_ids = get_field( 'catalogs', 'option' );

if ( ! is_shop() ) { ?>
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <?php get_template_part( 'components/page/content', 'breadcrumbs' ); ?>
      </div>
    </div>
  </div>
<?php } ?>

  <section class="shop" id="shop">
    <div class="container">
      <div class="row">
      <?php
      /**
       * Hook: woocommerce_archive_description.
       *
       * @hooked woocommerce_taxonomy_archive_description - 10
       * @hooked woocommerce_product_archive_description - 10
       */
      do_action( 'woocommerce_archive_description' );
      ?>

      <aside class="filters"><?php get_sidebar(); ?></aside>
      <div class="shop__products-container">
        <?php
          if ( ! is_search() ) {
            if (is_shop()) {
              ?>
              <h2 class="shop__title secondary-title shop__title--abs">
                <?php esc_html_e( 'Featured products', 'woocommerce' ); ?>
              </h2>
            <?php } else { ?>
              <h2 class="shop__title secondary-title shop__title--abs"><?php woocommerce_page_title(); ?></h2>
              <?php
            }
          }
        ?>

      <?php
        if ( woocommerce_product_loop() ) {

          /**
           * Hook: woocommerce_before_shop_loop.
           *
           * @hooked woocommerce_output_all_notices - 10
           * @hooked woocommerce_result_count - 20
           * @hooked woocommerce_catalog_ordering - 30
           */
          do_action( 'woocommerce_before_shop_loop' );

          woocommerce_product_loop_start();

          if ( wc_get_loop_prop( 'total' ) && ! is_shop() ) {
            while ( have_posts() ) {
              the_post();

              /**
               * Hook: woocommerce_shop_loop.
               */
              do_action( 'woocommerce_shop_loop' );

              mst_bodleid_the_product_html();

            }
          } else {
            $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
            $ordering = WC()->query->get_catalog_ordering_args();
            $ordering['orderby'] = array_shift( explode(' ', $ordering['orderby'] ) );
            $ordering['orderby'] = stristr( $ordering['orderby'], 'price' ) ?
              'meta_value_num' :
              $ordering['orderby'];

            $featured_products = wc_get_products( [
              'meta_key' => '_price',
              'status' => 'publish',
              'limit' => 6,
              'page' => $paged,
              'featured' => true,
              'paginate' => true,
              'return' => 'ids',
              'orderby' => $ordering['orderby'],
              'order' => $ordering['order'],
            ] );

            wc_set_loop_prop( 'current_page', $paged );
            wc_set_loop_prop( 'is_paginated', wc_string_to_bool( true ) );
            wc_set_loop_prop( 'page_template', get_page_template_slug() );
            wc_set_loop_prop( 'per_page', 6 );
            wc_set_loop_prop( 'total', $featured_products->total );
            wc_set_loop_prop( 'total_pages', $featured_products->max_num_pages );

            if( $featured_products ) {

              foreach ( $featured_products->products as $featured_product ) {
                $post_object = get_post( $featured_product );
                setup_postdata( $GLOBALS['post'] =& $post_object );
                mst_bodleid_the_product_html();
              }

              wp_reset_postdata();

            } else {
              do_action('woocommerce_no_products_found');
            }

            ?>
            <div class="fake-item"></div>
            <?php
          }


          woocommerce_product_loop_end();

            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action( 'woocommerce_after_shop_loop' );


        } else {
          /**
           * Hook: woocommerce_no_products_found.
           *
           * @hooked wc_no_products_found - 10
           */
          do_action( 'woocommerce_no_products_found' );
        }

        /**
         * Hook: woocommerce_after_main_content.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action( 'woocommerce_after_main_content' );

        /**
         * Hook: woocommerce_sidebar.
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        do_action( 'woocommerce_sidebar' );
      ?>

      </div>
    </div>
  </div>
</section>

<?php if ( is_shop() ) { ?>
  <section class="catalogs">
    <?php
      if ( ! empty( $catalogs_ids ) ) {
        foreach ( $catalogs_ids as $catalog ) {
          $rows = get_field( 'catalog_rows', $catalog );

          if ( is_array( $rows ) ) {
            foreach ($rows as $index => $row) {
              /* @var string $title Row title */
              $title = esc_html($row['row_info']['title']);

              /* @var string $desc Row description */
              $desc = wp_kses_post($row['row_info']['desc']);

              /* @var string $image_src Row right image */
              $image_src = esc_url($row['row_info']['image']['url']);

              /* @var string $image_alt */
              $image_alt = esc_url($row['row_info']['image']['alt']);

              /* @var array $products WC products IDs */
              $products = $row['products'];

              /* @var string $button_title */
              $button_title = esc_html($row['button']['title']);

              /* @var string $button_href */
              $button_href = esc_url($row['button']['href']);
              ?>

              <section class="category-product
            <?php echo $index % 2 === 0 ? 'category-product--yellow' : 'category-product--black'; ?>">
                <div class="container">
                  <div class="row">
                    <div class="category-product__wrapper">
                      <div class="products__service">
                        <h3 class="tertiary-title products__service-title"><?php echo $title; ?></h3>
                        <div class="fake-list products__service-desc">
                          <?php echo $desc; ?>

                          <div class="products__img-box">
                            <img src="<?php echo $image_src; ?>" alt="<?php echo $image_alt; ?>" class="products__img">
                          </div>
                        </div>

                        <?php if ( $button_title && ! $products ) { ?>
                          <a href="<?php echo $button_href; ?>" class="shop-link shop-link--align-left">
                            <?php echo $button_title; ?>
                          </a>
                        <?php } ?>
                      </div>

                      <?php if ( ! empty( $products ) && function_exists( 'mst_bodleid_the_product_html' ) ) { ?>
                        <ul class="category-product__product-list">
                          <?php
                          foreach ( $products as $product ) {
                            mst_bodleid_the_product_html( $product );
                          }
                          ?>
                        </ul>
                      <?php } ?>

                      <?php if ( $button_title && $products ) { ?>
                        <a href="<?php echo $button_href; ?>" class="shop-link"><?php echo $button_title; ?></a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </section>

              <?php
            }
          }
        }
      }
    ?>
  </section>
<?php } ?>

<?php
get_footer( 'shop' );
