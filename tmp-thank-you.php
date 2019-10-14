<?php
/*
  Template Name: Thank you page
*/

defined( 'ABSPATH' ) || exit;

/* @var int $order_id */
$order_id = (int) $_GET['order_id'];

if ( empty( $order_id ) ) {
  wp_redirect( home_url() );
}

/* @var WC_Order $order_data */
$order_data = wc_get_order( $order_id );

/* @var string $id_string */
$id_string = esc_html( sprintf( '#%d', $order_id ) );

/* @var string $date */
$date = esc_html( $order_data->get_date_created()->date_i18n( 'd M Y' ) );

/* @var string $total */
$total = wp_kses_post( $order_data->get_formatted_order_total() );

/* @var WC_Order_Item[] $items */
$items = $order_data->get_items();

get_header();
?>

  <main class="main" id="content" role="main">
    <section class="order-received" id="order-received">
      <div class="container">
        <div class="row">
          <h1 class="primary-title order-received__title">
            <?php esc_html_e( 'Thanks, order received', 'mst_bodleid' ); ?>
          </h1>

          <div class="order-received__content-wrap">
            <div class="order-received__order-info-column">
              <div class="order-received__order-info-wrap">
                <div class="order-received__order-info-box">
                  <h3 class="order-received__order-info-title orders__headline order-received__title-id">
                    <?php esc_html_e( 'Order number', 'mst_bodleid' ); ?>
                  </h3>
                  <p class="order-received__info order-received__info-id"><?php echo $id_string; ?></p>
                </div>
                <div class="order-received__order-info-box">
                  <h3 class="order-received__order-info-title orders__headline order-received__title-date">
                    <?php esc_html_e( 'Date', 'mst_bodleid' ); ?>
                  </h3>
                  <p class="order-received__info order-received__info-date"><?php echo $date; ?></p>
                </div>
                <div class="order-received__order-info-box">
                  <h3 class="order-received__order-info-title orders__headline order-received__title-price">
                    <?php esc_html_e( 'Total', 'mst_bodleid' ); ?>
                  </h3>
                  <p class="order-received__info order-received__info-price">
                    <?php echo $total; ?>
                  </p>
                </div>
                <div class="order-received__order-info-box">
                  <h3 class="order-received__order-info-title orders__headline order-received__title-payment">
                    <?php esc_html_e( 'Payment method', 'mst_bodleid' ); ?>
                  </h3>
                  <p class="order-received__info order-received__info-payment">
                    Valitor greiðslusíða
                  </p>
                </div>
              </div>
            </div>

            <div class="order-received__products-info-column">
              <table class="order-received__product-info-table">
                <thead class="order-received__product-info-headlines">
                  <tr>
                    <th class="order-received__product-headline order-received__product-headline-product">
                      <?php esc_html_e( 'Product', 'mst_bodleid' ); ?>
                    </th>
                    <th class="order-received__product-headline order-received__product-headline-quantity">
                      <?php esc_html_e( 'Amount', 'mst_bodleid' ); ?>
                    </th>
                    <th class="order-received__product-headline order-received__product-headline-price">
                      <?php esc_html_e( 'Total', 'mst_bodleid' ); ?>
                    </th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  foreach ( $items as $item ) {
                    /* @var array $item_data */
                    $item_data = $item->get_data();

                    /* @var string $title Product title */
                    $title = esc_html( $item_data['name'] );

                    /* @var string $amount */
                    $amount = esc_html( $item_data['quantity'] );

                    /* @var string $amount */
                    $line_total = wc_price( $item_data['total'] );

                    /* @var WC_Product $product */
                    $product = wc_get_product( $item_data['product_id'] );

                    /* @var string $sku */
                    $sku = $product->get_sku();
                  }
                ?>
                  <tr class="order-received__product-info-content">
                    <td data-label="Vara">
                      <p class="order-received__product-name">
                        <?php echo $title; ?>
                      </p>
                      <p class="order-received__product-model">
                        <?php echo esc_html( sprintf( '%s: %s', __( 'Model', 'mst_bodleid' ), $sku ) ); ?>
                      </p>
                    </td>
                    <td data-label="<?php esc_html_e( 'Amount', 'mst_bodleid' ); ?>"
                        class="order-received__product-quantity">
                      <?php echo $amount; ?>
                    </td>
                    <td data-label="<?php esc_html_e( 'Total', 'mst_bodleid' ); ?>"
                        class="order-received__product-price">
                      <?php echo $line_total; ?>
                    </td>
                  </tr>
                </tbody>
              </table>

              <table class="order-received__total-price-table">
                <tbody>
                <tr class="order-received__total-price-table-row">
                  <td><?php esc_html_e( 'Price without VAT', 'mst_bodleid' ); ?></td>
                  <td><?php echo $total; ?></td>
                </tr>
                <tr class="order-received__total-price-table-row">
                  <td><?php esc_html_e( 'Home delivery within Iceland', 'mst_bodleid' ); ?></td>
                  <td><?php echo wc_price( 0 ); ?></td>
                </tr>
                <tr class="order-received__total-price-table-row">
                  <td>VSK (24%):</td>
                  <td><?php echo wc_price( 326.19 * 0.24 ); ?></td>
                </tr>
                <tr class="order-received__total-price-table-row">
                  <td><?php esc_html_e( 'Total', 'mst_bodleid' ); ?></td>
                  <td class="order-received__total-price-sum"><?php echo $total; ?></td>
                </tr>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php
get_footer();
