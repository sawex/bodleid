<?php
/**
 * Template part for displaying shop title
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 * @since 1.0.0
 */
?>

<?php if ( is_shop() && ! is_search() ) { ?>
  <h2 class="shop__title secondary-title shop__title--abs">
    <?php esc_html_e( 'Featured products', 'woocommerce' ); ?>
  </h2>
<?php } ?>

<?php if ( is_archive() && ! is_shop() || is_search() ) { ?>
  <h2 class="shop__title secondary-title shop__title--abs"><?php woocommerce_page_title(); ?></h2>
<?php } ?>