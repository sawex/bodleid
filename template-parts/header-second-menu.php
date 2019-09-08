<?php
/**
 * Template part for displaying header second menu
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 */

$support_link = esc_url( get_field( 'support_link', 'option' ) );
?>

<ul class="header__user-cases">
  <?php if ( function_exists( 'wc_get_cart_url' ) ) { ?>
    <li class="header__cart-item">
      <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="header__cart-link">
        <?php esc_html_e( 'Cart', 'mst_bodleid' ); ?>
      </a>
    </li>
  <?php } ?>

  <?php if ( $support_link ) { ?>
    <li class="header__user-item">
      <a href="<?php echo $support_link; ?>" class="header__user-link">
        <?php esc_html_e( 'Support', 'mst_bodleid' ); ?>
      </a>
    </li>
  <?php } ?>
</ul>
