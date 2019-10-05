<?php
/**
 * Template part for displaying header second menu
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 */
?>

<ul class="header__user-cases">
  <li class="header__user-item">
    <a href="#" class="header__user-link">
      <object data="images/icons/user.svg" type="image/svg+xml"></object>
    </a>
  </li>

  <li class="header__comparison-item">
    <a href="#" class="header__comparison-link">
      <object data="images/icons/ref.svg" type="image/svg+xml"></object>
    </a>
  </li>

  <?php if ( function_exists( 'wc_get_cart_url' ) ) { ?>
    <li class="header__cart-item">
      <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="header__cart-link">
        <object data="images/icons/cart.svg" type="image/svg+xml"></object>
      </a>
    </li>
  <?php } ?>

</ul>