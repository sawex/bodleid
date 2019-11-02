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

/* @var int $orders_count Order rows per page */
$orders_count = (int) get_field( 'account', 'option' )['orders_count'];

/* @var int $paged */
$paged = get_query_var( 'paged' ) ?: 1;

/* @var stdClass $orders */
$orders_data = wc_get_orders( [
  'customer_id' => $user_id,
  'limit' => $orders_count,
  'paged' => $paged,
  'paginate' => true,
] );

/* @var WC_Order[] $orders */
$orders = $orders_data->orders;

/* @var float $pages */
$pages = $orders_data->max_num_pages;

/* @var string $thank_you_page_url */
$thank_you_page_url = esc_url( get_permalink( get_page_by_path( 'order' ) ) );
?>

<div class="orders">
  <?php if ( ! empty( $orders ) ) { ?>
    <table class="orders__table">
      <thead>
        <tr>
          <th class="orders__headline orders__headline--id">
            <?php esc_html_e( 'Order number', 'mst_bodleid' ); ?>
          </th>
          <th class="orders__headline orders__headline--date">
            <?php esc_html_e( 'Date', 'mst_bodleid' ); ?>
          </th>
          <th class="orders__headline orders__headline--status">
            <?php esc_html_e( 'Status', 'mst_bodleid' ); ?>
          </th>
          <th class="orders__headline orders__headline--total-summ">
            <?php esc_html_e( 'Total', 'mst_bodleid' ); ?>
          </th>
          <th> </th>
        </tr>
      </thead>
      <tbody>
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
          ?>

            <tr>
              <td data-text="<?php esc_html_e( 'Order number', 'mst_bodleid' ); ?>"
                  class="orders__info-id">
                <span><?php echo $id; ?></span>
              </td>
              <td data-text="<?php esc_html_e( 'Date', 'mst_bodleid' ); ?>"
                  class="orders__info-datе">
                <span><?php echo $date; ?></span>
              </td>
              <td data-text="<?php esc_html_e( 'Status', 'mst_bodleid' ); ?>"
                  class="orders__info-status">
                <span><?php echo $status; ?></span>
              </td>
              <td data-text="<?php esc_html_e( 'Total', 'mst_bodleid' ); ?>"
                  class="orders__info-total-summ">
                <?php echo $total; ?>
              </td>
              <td>
                <a href="<?php echo $order_url; ?>" class="orders__view-btn">
                  <?php esc_html_e( 'View', 'mst_bodleid' ); ?>
                </a>
              </td>
            </tr>

          <?php } ?>
      </tbody>
    </table>

    <?php
    $pagination_elements = paginate_links( [
      'base'         => '/account/page/%#%',
      'total'        => $pages,
      'current'      => max( 1, $paged ),
      'format'       => '/account/page/%#%',
      'show_all'     => true,
      'prev_next'    => false,
      'type'         => 'array',
      'add_args'     => false,
      'add_fragment' => '',
    ] );
    ?>

    <ul class="orders__pagination">

      <?php foreach ( $pagination_elements as $pagination_element ) {
        $pagination_element = (string) $pagination_element;

        $pagination_element = str_replace(
          'page-numbers current',
          'orders__pagination-link orders__pagination-link--active',
          $pagination_element
        );

        $pagination_element = str_replace(
          'page-numbers',
          'orders__pagination-link',
          $pagination_element
        );

        ?>

        <li class="orders__pagination-item">
          <?php echo $pagination_element; ?>
        </li>
      <?php } ?>

    </ul>

  <?php } else { ?>
    <div class="search__result-title-box">
      <h2 class="secondary-title search__result-title">
        <?php esc_html_e( 'No orders were found matching your selection.', 'woocommerce' ); ?>
      </h2>
    </div>
  <?php } ?>
</div>
