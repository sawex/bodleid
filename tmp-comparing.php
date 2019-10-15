<?php
/*
  Template Name: Comparing page
*/

defined( 'ABSPATH' ) || exit;

/* @var array|null $product_ids */
$product_ids = (array) WC()->session->get( 'mst_bodleid_comparing_list' );

if ( ! empty( $product_ids ) ) {
  /* @var array|stdClass $products */
  $products = wc_get_products( [
    'include' => $product_ids,
  ] );

  $titles_row = '';
  $skus_row = '';
  $images_row = '';
  $prices_row = '';
  $stock_row = '';
  $desc_row = '';

  foreach ( $products as $product ) {
    /* @var string $product_id */
    $product_id = (string) $product->get_id();

    /* @var int $post_thumbnail_id */
    $post_thumbnail_id = $product->get_image_id();

    /* @var string $product_image */
    $product_image = esc_url( wp_get_attachment_image_src( $post_thumbnail_id, 'medium' )[0] );

    /* @var string $stock_status */
    $stock_status = $product->get_stock_status() ?
      esc_html__( 'In stock', 'mst_bodleid' ) :
      esc_html__( 'Not in stock', 'mst_bodleid' );

    $titles_row .= sprintf( '<th data-product-id="%s">%s</th>', $product_id, $product->get_title() );
    $skus_row .= sprintf( '<td data-product-id="%s">%s</td>', $product_id, $product->get_sku() );
    $images_row .= sprintf( '<td data-product-id="%s"><div class="compare__img-box"><img src="%s" alt="" class="compare__img"></div></td>', $product_id, $product_image );
    $prices_row .= sprintf( '<td data-product-id="%s">%s</td>', $product_id, $product->get_price_html() );
    $stock_row .= sprintf( '<td data-product-id="%s"><div class="compare__status"><p>%s</p></div></td>', $product_id, $stock_status );

    ob_start();
?>
    <td data-product-id="<?php echo esc_attr( $product_id ); ?>">
      <p><?php echo $product->get_short_description(); ?></p>

      <div class="to-cart-box">
        <!-- TODO: .add-to-catr-bnt -->
        <a href="<?php esc_url( $product->add_to_cart_url() ); ?>" class="add-to-catr-bnt">
          <?php esc_html_e( 'Add to cart', 'mst_bodleid' ); ?>
        </a>
      </div>

      <div class="compare__remove-box" data-id="<?php echo esc_attr( $product_id ); ?>">
        <a class="compare__remove-bnt">
          <?php esc_html_e( 'Remove from comparison', 'mst_bodleid' ); ?>
        </a>
      </div>
    </td>
    <?php

    $desc_row .= ob_get_clean();
  }
}

get_header();
?>

  <main class="main" id="content" role="main">
    <section class="compare" id="compare">
      <div class="container">
        <div class="row">
          <h2 class="secondary-title compare__title">
            <?php esc_html_e( 'Comparison', 'mst_bodleid' ); ?>
          </h2>

          <?php if ( $product_ids ) { ?>

<!--            <form class="compare__hide-filter">-->
<!--              <input class="compare__hide-input" type="checkbox" name="hide-filter" id="hide-filter-check">-->
<!--              <label class="compare__hide-label" for="hide-filter-check">-->
<!--                --><?php //esc_html_e( 'Hide attributes with same values', 'mst_bodleid' ); ?>
<!--              </label>-->
<!--            </form>-->

            <div class="compare__table-wrap">
              <table class="compare__table">

                <thead>
                  <tr class="compare__name-row"
                      data-desc="<?php esc_html_e( 'Product', 'mst_bodleid' ); ?>">
                    <th><?php esc_html_e( 'Product', 'mst_bodleid' ); ?></th>
                    <?php echo wp_kses_post( $titles_row ); ?>
                  </tr>
                </thead>

                <tbody>

                  <tr class="compare__model-row"
                      data-desc="<?php esc_html_e( 'Model', 'mst_bodleid' ); ?>">
                    <th><?php esc_html_e( 'Model', 'mst_bodleid' ); ?></th>
                    <?php echo wp_kses_post( $skus_row ); ?>
                  </tr>

                  <tr class="compare__img-row"
                      data-desc="<?php esc_html_e( 'Picture', 'mst_bodleid' ); ?>">
                    <th><?php esc_html_e( 'Picture', 'mst_bodleid' ); ?></th>
                    <?php echo wp_kses_post( $images_row ); ?>
                  </tr>

                  <tr class="compare__price-row"
                      data-desc="<?php esc_html_e( 'Price', 'mst_bodleid' ); ?>">
                    <th><?php esc_html_e( 'Price', 'mst_bodleid' ); ?></th>
                    <?php echo wp_kses_post( $prices_row ); ?>
                  </tr>

                  <tr class="compare__status-row"
                      data-desc="<?php esc_html_e( 'Availability', 'mst_bodleid' ); ?>">
                    <th><?php esc_html_e( 'Availability', 'mst_bodleid' ); ?></th>
                    <?php echo wp_kses_post( $stock_row ); ?>
                  </tr>

                  <tr class="compare__desc-row"
                      data-desc="<?php esc_html_e( 'Description', 'mst_bodleid' ); ?>">
                    <th><?php esc_html_e( 'Description', 'mst_bodleid' ); ?></th>
                    <?php echo wp_kses_post( $desc_row ); ?>
                  </tr>
                </tbody>
              </table>
            </div>

          <?php } else { ?>
            <div class="search__result-title-box">
              <h2 class="secondary-title search__result-title">
                <?php esc_html_e( 'No products were found matching your selection.', 'woocommerce' ); ?>
              </h2>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>
  </main>

<?php
get_footer();
