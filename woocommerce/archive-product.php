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
        <div class="shop__products-row">
          <div class="woocommerce-notices-wrapper woocommerce-notices-wrapper--archive">
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

      <?php get_template_part( 'components/shop/shop', 'title' ); ?>

      <?php
        if ( woocommerce_product_loop() ) {

          /**
           * Hook: woocommerce_before_shop_loop.
           *
           * @hooked woocommerce_result_count - 20
           * @hooked woocommerce_catalog_ordering - 30
           */
          do_action( 'woocommerce_before_shop_loop' );

          woocommerce_product_loop_start();

          if ( wc_get_loop_prop( 'total' ) && ( is_search() || ! is_shop() ) ) {
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
            $ordering_formatted = explode(' ', $ordering['orderby'] );
            $ordering['orderby'] = array_shift( $ordering_formatted );
            $ordering['orderby'] = stristr( $ordering['orderby'], 'price' ) ?
              'meta_value_num' :
              $ordering['orderby'];
            $per_page = get_field( 'featured_count', 'option' );

            $featured_products = wc_get_products( [
              'meta_key' => '_price',
              'status' => 'publish',
              'limit' => $per_page,
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
            wc_set_loop_prop( 'per_page', $per_page );
            wc_set_loop_prop( 'total', $featured_products->total );
            wc_set_loop_prop( 'total_pages', $featured_products->max_num_pages );

            if ( $featured_products ) {

              foreach ( $featured_products->products as $featured_product ) {
                $post_object = get_post( $featured_product );
                setup_postdata( $GLOBALS['post'] =& $post_object );
                mst_bodleid_the_product_html( null, 'li', 'h3' );
              }

              wp_reset_postdata();

            } else {
              do_action( 'woocommerce_no_products_found' );
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

<?php
  if ( is_shop() ) {
    get_template_part( 'components/shop/shop', 'catalogs' );
  }
?>

<?php
get_footer( 'shop' );
