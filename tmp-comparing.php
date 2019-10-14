<?php
/*
  Template Name: Comparing page
*/

defined( 'ABSPATH' ) || exit;

$products = wc_get_products( [
  'include' => (array) WC()->session->get( 'mst_bodleid_comparing_list' )
] );

get_header();
?>

  <main class="main" id="content" role="main">
    <section class="compare" id="compare">
      <div class="container">
        <div class="row compare--overflow">
          <h2 class="secondary-title compare__title">
            <?php esc_html_e( 'Comparison', 'mst_bodleid' ); ?>
          </h2>

          <form class="compare__hide-filter">
            <input class="compare__hide-input" type="checkbox" name="hide-filter" id="hide-filter-check" checked>
            <label class="compare__hide-label" for="hide-filter-check">
              <?php esc_html_e( 'Hide attributes with same values', 'mst_bodleid' ); ?>
            </label>
          </form>

          <table class="compare__table">
            <thead>
            <tr class="compare__name-row" data-desc="Vara">
              <?php foreach ( $products as $product ) { ?>
                <th><?php echo $product->get_title(); ?></th>
              <?php } ?>
           </tr>
            </thead>
            <tbody>
            <tr class="compare__model-row" data-desc="Módel">
              <?php foreach ( $products as $product ) { ?>
                <td><?php echo $product->get_sku(); ?></td>
              <?php } ?>
            </tr>
            <tr class="compare__img-row" data-desc="Mynd">
              <?php foreach ( $products as $product ) {
                $post_thumbnail_id = $product->get_image_id();
                ?>
                <td>
                  <div class="compare__img-box">
                    <img src="<?php echo esc_url( wp_get_attachment_image_src( $post_thumbnail_id, 'medium' )[0] ) ?>" alt="camera" class="compare__img">
                  </div>
                </td>
              <?php } ?>
            </tr>
            <tr class="compare__price-row" data-desc="Verð">
              <?php foreach ( $products as $product ) { ?>
                <td><?php echo $product->get_price_html(); ?></td>
              <?php } ?>
            </tr>
            <tr class="compare__status-row" data-desc="Lagerstaða">
              <?php foreach ( $products as $product ) { ?>
                <td>
                  <div class="compare__status">
                    <p>Til á lager</p>
                  </div>
                </td>
              <?php } ?>
            </tr>
            <tr class="compare__desc-row" data-desc="Lýsing">
              <?php foreach ( $products as $product ) { ?>
                <td>
                  <p><?php echo $product->get_short_description(); ?></p>

                  <div class="to-cart-box">
                    <a href="<?php esc_url( $product->add_to_cart_url() ); ?>" class="add-to-catr-bnt">Setja í körfu</a>
                  </div>

                  <div class="compare__remove-box" data-id="<?php echo $product->get_id(); ?>">
                    <a href="#" class="compare__remove-bnt">Fjarlægja úr samanburð</a>
                  </div>
                </td>
              <?php } ?>

            </tr>
            </tbody>
          </table>

        </div>
      </div>
    </section>
  </main>

<?php
get_footer();
