<?php
/**
 * Template part for displaying orders table in account
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 * @since 1.0.0
 */

/* @var int $user_id */
$user_id = get_current_user_id();

/* @var stdClass $orders */
$orders_data = wc_get_orders( [
  'customer_id' => $user_id,
  'limit' => 4,
  'paged' => 1,
  'paginate' => true,
] );

/* @var WC_Order[] $orders */
$orders = $orders_data->orders;

/* @var float $pages */
$pages = $orders_data->max_num_pages;

/* @var string $thank_you_page_url */
$thank_you_page_url = esc_url( get_permalink( get_page_by_path( 'order-received' ) ) );
?>

<div class="orders">
  <?php if ( ! empty( $orders ) ) { ?>
    <div class="orders__headlines-box">
      <h3 class="orders__headline orders__headline--id">
        <?php esc_html_e( 'Order number', 'mst_bodleid' ); ?>
      </h3>
      <h3 class="orders__headline orders__headline--date">
        <?php esc_html_e( 'Date', 'mst_bodleid' ); ?>
      </h3>
      <h3 class="orders__headline orders__headline--status">
        <?php esc_html_e( 'Status', 'mst_bodleid' ); ?>
      </h3>
      <h3 class="orders__headline orders__headline--total-summ">
        <?php esc_html_e( 'Total', 'mst_bodleid' ); ?>
      </h3>
    </div>

    <?php
      foreach ( $orders as $order ) {
        /* @var string $id */
        $id = esc_html( sprintf( '#%d', $order->get_id() ) );

        /* @var string $status */
        $status = esc_html( ucfirst( $order->get_status() ) );

        /* @var string $date */
        $date = esc_html( $order->get_date_created()->date_i18n( 'M d, Y' ) );

        /* @var string $total */
        $total = wp_kses_post( $order->get_formatted_order_total() );

        /* @var string $order_url */
        $order_url = esc_url( add_query_arg( [ 'order_id' => $order->get_id() ], $thank_you_page_url ) );
      }
    ?>

    <div class="orders__order-info-box">
      <p class="orders__info-id"><?php echo $id; ?></p>
      <p class="orders__info-datе"><?php echo $date; ?></p>
      <p class="orders__info-status"><?php echo $status; ?></p>
      <p class="orders__info-total-summ"><?php echo $total; ?></p>
      <a href="<?php echo $order_url; ?>" class="orders__view-btn">
        <?php esc_html_e( 'View', 'mst_bodleid' ); ?>
      </a>
    </div>

    <?php if ( ! empty( $pages ) && (int) $pages !== 1 ) { ?>
      <ul class="orders__pagination">
        <?php for ( $counter = 1; $counter <= $pages; $counter++ ) { ?>
          <li class="orders__pagination-item">
            <a class="orders__pagination-link orders__pagination-link--active">
              <?php echo $counter; ?>
            </a>
          </li>
        <?php } ?>
      </ul>
    <?php } ?>

  <?php } else { ?>
    <p class="orders__none">
      <?php esc_html_e( 'You don\'t have orders for now', 'mst_bodleid' ); ?>
    </p>
  <?php } ?>
</div>
