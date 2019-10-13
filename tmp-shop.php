<?php
/*
  Template Name: Shop page
*/

defined( 'ABSPATH' ) || exit;

get_header();

$featured_products = wc_get_products( [ 'featured' => true ] );
?>

<main class="main" id="content" role="main">
  <?php get_template_part( 'components/page/content', 'banner' ); ?>

  <section class="shop" id="shop">
    <div class="container">
      <div class="row">
        <aside class="filters"><?php get_sidebar(); ?></aside>

        <div class="shop__products-container">
          <h2 class="shop__title secondary-title shop__title--abs">Yealink símtæki</h2>
          <form class="woocommerce-ordering" method="get">
            <label>
              <select name="orderby" class="orderby" aria-label="Shop order">
                <option value="menu_order" selected="selected">Default sorting</option>
                <option value="popularity">Sort by popularity</option>
                <option value="rating">Sort by average rating</option>
                <option value="date">Sort by latest</option>
                <option value="price">Sort by price: low to high</option>
                <option value="price-desc">Sort by price: high to low</option>
              </select>
            </label>
            <input type="hidden" name="paged" value="1">
          </form>

          <ul class="product-menu">
            <?php
              if ( ! empty( $featured_products ) && function_exists( 'mst_bodleid_the_product_html' ) ) {
                foreach ( $featured_products as $featured_product ) {
                  mst_bodleid_the_product_html( $featured_product );
                }
              }
            ?>
          </ul>

<!--          <ul class="orders__pagination">-->
<!--            <li class="orders__pagination-item">-->
<!--              <a href="#" class="orders__pagination-link orders__pagination-link--active">1</a>-->
<!--            </li>-->
<!--            <li class="orders__pagination-item">-->
<!--              <a href="#" class="orders__pagination-link">2</a>-->
<!--            </li>-->
<!--            <li class="orders__pagination-item">-->
<!--              <a href="#" class="orders__pagination-link">3</a>-->
<!--            </li>-->
<!--            <li class="orders__pagination-item">-->
<!--              <a href="#" class="orders__pagination-link">4</a>-->
<!--            </li>-->
<!--            <li class="orders__pagination-item">-->
<!--              <a href="#" class="orders__pagination-link">5</a>-->
<!--            </li>-->
<!--          </ul>-->
        </div>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();