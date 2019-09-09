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

$rows = get_field( 'catalog_rows' );

?>

  <main class="main">
    <?php get_template_part( 'template-parts/content', 'banner' ); ?>

    <?php
      if ( is_array( $rows ) ) {
        foreach ( $rows as $index => $row ) {
          $title = esc_html( $row['row_info']['title'] );
          $desc = $row['row_info']['desc'];
          $image_src = esc_url( $row['row_info']['image']['url'] );
          $image_alt = esc_url( $row['row_info']['image']['alt'] );

          /* @var array $products WC products IDs */
          $products = $row['products'];

          $button_title = esc_html( $row['button']['title'] );
          $button_href = esc_url( $row['button']['href'] );
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
                      <a href="<?php echo $button_href; ?>" class="shop-link"><?php echo $button_title; ?></a>
                    <?php } ?>
                  </div>

                  <?php if ( $products ) { ?>
                    <ul class="category-product__product-list">
                      <li class="category-product__product-list-item">
                        <a href="#" class="category-product__product-link">
                          <div class="category-product__img-box">
                            <img src="images/product-img.png" alt="#" class="category-product-img">
                          </div>

                          <div class="category-product__product-info">
                            <h4>Yealink RT10</h4>
                            <p>Yealink RT10 Repeater er hægt að nota þar sem þörf er á því auka drægni á þráðlausum
                              símum…</p>
                          </div>

                          <div class="category-product__price">
                            <p>26.189kr <span>án/vsk: 21.120kr</span></p>
                          </div>
                        </a>
                      </li>
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

