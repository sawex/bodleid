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

/* @var string $status */
$status = esc_html( ucfirst( $order_data->get_status() ) );

/* @var string $payment_method_title */
$payment_method_title = esc_html( $order_data->get_payment_method_title() );

/* @var string $payment_method_slug */
$payment_method_slug = $order_data->get_payment_method();

/* @var string $total */
$total = wp_kses_post( $order_data->get_formatted_order_total() );

/* @var string $order_shipping_total */
$order_shipping_total = wc_price( $order_data->get_shipping_total() );

/* @var string $taxes */
$taxes = wc_price( $order_data->__get('total_tax') );

/* @var string $total_ex_tax */
$total_ex_tax = wc_price( $order_data->get_total() - $order_data->__get('total_tax')  );

/* @var WC_Order_Item[] $items */
$items = $order_data->get_items();

if ( $order_data->is_paid() ) {
  if ( $payment_method_slug === 'valitor' ) {
    $status = esc_html__( 'Paid', 'mst_bodleid' );
  } else if ( $payment_method_slug === 'cod' ) {
    $status = esc_html__( 'Invoiced', 'mst_bodleid' );
  }
}

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
                    <?php echo $payment_method_title; ?>
                  </p>
                </div>

                <div class="order-received__order-info-box">
                  <h3 class="order-received__order-info-title orders__headline order-received__title-payment">
                    <?php esc_html_e( 'Status', 'mst_bodleid' ); ?>
                  </h3>
                  <p class="order-received__info order-received__info-payment">
                    <?php echo $status; ?>
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
                    $line_total = wc_price( $item_data['subtotal'] + $item_data['subtotal_tax'] );

                    /* @var WC_Product $product */
                    $product = wc_get_product( $item_data['product_id'] );

                    /* @var string $sku */
                    $sku = $product->get_sku();

                    /* @var string $permalink */
                    $permalink = esc_url( $product->get_permalink() );
                  }
                ?>
                  <tr class="order-received__product-info-content">
                    <td data-label="<?php esc_attr_e( 'Product', 'mst_bodleid' ); ?>">
                      <p class="order-received__product-name">
                        <a href="<?php echo $permalink; ?>"><?php echo $title; ?></a>
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
                  <td><?php echo $total_ex_tax; ?></td>
                </tr>
                <tr class="order-received__total-price-table-row">
                  <td><?php esc_html_e( 'Home delivery within Iceland', 'mst_bodleid' ); ?></td>
                  <td><?php echo $order_shipping_total; ?></td>
                </tr>
                <tr class="order-received__total-price-table-row">
                  <td>VSK (24%):</td>
                  <td><?php echo $taxes; ?></td>
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
