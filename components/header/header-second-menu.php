<?php
/**
 * Template part for displaying header second menu
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 */

global $post;

/* @var string $slug Current page slug */
$slug = $post->post_name;

/* @var string $account_page */
$account_page = esc_url( get_permalink( get_page_by_path( 'account' ) ) );

/* @var string $login_page */
$login_page = esc_url( get_permalink( get_page_by_path( 'login' ) ) );

/* @var string $comparing_page */
$comparing_page = esc_url( get_permalink( get_page_by_path( 'products-comparing' ) ) );
?>

<ul class="header__user-cases">
  <li class="header__user-item
    <?php echo ( $slug === 'account' || $slug === 'login' ) ? 'header__user-list--active ' : ''; ?>">
    <?php if ( is_user_logged_in() ) { ?>
      <a href="<?php echo $account_page; ?>"
         class="header__user-link"
         aria-label="<?php esc_attr_e( 'Account', 'mst_bodleid' ); ?>">
    <?php } else { ?>
      <a href="<?php echo $login_page; ?>"
         class="header__user-link"
         aria-label="<?php esc_attr_e( 'Sign in', 'mst_bodleid' ); ?>">
    <?php } ?>
        <?php mst_bodleid_the_theme_svg( 'user' ); ?>
      </a>
  </li>

  <li class="header__comparison-item
    <?php echo $slug === 'products-comparing' ? 'header__user-list--active ' : ''; ?>">
    <a href="<?php echo $comparing_page; ?>" class="header__comparison-link">
      <?php
        mst_bodleid_the_theme_svg( 'comparison' );

        if ( mst_bodleid_comparison_products_count() ) {
      ?>
        <span class="quantity-product-circle"><?php echo esc_html( mst_bodleid_comparison_products_count() ); ?></span>
      <?php } ?>
    </a>
  </li>

  <?php if ( function_exists( 'wc_get_cart_url' ) ) { ?>
    <li class="header__cart-item <?php echo ( is_cart() || is_checkout())  ? 'header__user-list--active ' : ''; ?>">
      <a href="<?php echo esc_url( wc_get_cart_url() ); ?>"
         class="header__cart-link">
        <?php mst_bodleid_the_theme_svg( 'cart' ); ?>
        <span class="quantity-product-circle"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
      </a>
    </li>
  <?php } ?>
</ul>