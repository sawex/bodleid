<?php
/**
 * Template part for displaying header second menu
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 */

/* @var string $account_page */
$account_page = esc_url( get_permalink( get_page_by_path( 'account' ) ) );

/* @var string $login_page */
$login_page = esc_url( get_permalink( get_page_by_path( 'login' ) ) );
?>

<ul class="header__user-cases">
  <li class="header__user-item">
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

  <li class="header__comparison-item">
    <a href="#" class="header__comparison-link">
      <?php mst_bodleid_the_theme_svg( 'comparison' ); ?>
    </a>
  </li>

  <?php if ( function_exists( 'wc_get_cart_url' ) ) { ?>
    <li class="header__cart-item" data-count="<?php echo WC()->cart->get_cart_contents_count(); ?>">
      <a href="<?php echo esc_url( wc_get_cart_url() ); ?>"
         class="header__cart-link">
        <?php mst_bodleid_the_theme_svg( 'cart' ); ?>
      </a>
    </li>
  <?php } ?>
</ul>