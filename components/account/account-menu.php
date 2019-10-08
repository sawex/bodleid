<?php
/**
 * Template part for displaying account menu
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 * @since 1.0.0
 */
?>

<ul class="account__nav-list">
  <li class="account__nav-list-item">
    <a class="account__nav-link account__nav-link--active" data-href="orders">
      <?php esc_html_e( 'Orders', 'mst_bodleid' ); ?>
    </a>
  </li>
  <li class="account__nav-list-item">
    <a class="account__nav-link" data-href="account">
      <?php esc_html_e( 'Account details', 'mst_bodleid' ); ?>
    </a>
  </li>
  <li class="account__nav-list-item">
    <a href="<?php echo wp_logout_url( home_url() ); ?>"
       class="account__nav-link">
      <?php esc_html_e( 'Log out', 'mst_bodleid' ); ?>
    </a>
  </li>
</ul>
