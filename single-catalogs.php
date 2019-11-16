<?php
/**
 * The template for displaying catalog single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bodleid
 */

defined( 'ABSPATH' ) || exit;
get_header();

/* @var array $rows */
$rows = get_field( 'catalog_rows' );
?>

  <main class="main" id="content" role="main">
    <?php get_template_part( 'components/page/content', 'banner' ); ?>

    <?php
      if ( is_array( $rows ) ) {
        foreach ( $rows as $index => $row ) {
          /* @var string $title Row title */
          $title = esc_html( $row['row_info']['title'] );

          /* @var string $desc Row description */
          $desc = wp_kses_post( $row['row_info']['desc'] );

          /* @var string $image_src Row right image */
          $image_src = esc_url( $row['row_info']['image']['url'] );

          /* @var string $image_alt */
          $image_alt = esc_url( $row['row_info']['image']['alt'] );

          /* @var array $products WC products IDs */
          $products = $row['products'];

          /* @var string $button_title */
          $button_title = esc_html( $row['button']['title'] );

          /* @var string $button_href */
          $button_href = esc_url( $row['button']['href'] );
          ?>

          <section class="category-product
            <?php echo $index % 2 === 0 ? 'category-product--yellow' : 'category-product--black'; ?>">
            <div class="container">
              <div class="row">
                <div class="category-product__wrapper">
                  <div class="products__service">
                    <h2 class="tertiary-title products__service-title"><?php echo $title; ?></h2>
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
                          mst_bodleid_the_product_html( $product, 'li', 'h3' );
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
      ?>
  </main>

<?php
get_footer();

