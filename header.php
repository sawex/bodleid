<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bodleid
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <a class="skip-link screen-reader-text" href="#content">
    <?php esc_html_e( 'Skip to content', 'mst_bodleid' ); ?>
  </a>
  <!--       _
       .__(.)< (MEOW)
        \___)
  ~~~~~~~~~~~~~~~~~-->

  <!--
   ________________$$____________$$
  _______________$___$________$___$
  _______________$_____$$$$$$_____$ 		.	.	.	.
  _______________$____sss_ __sss____$ . 	     	.
  _______________$____іі_____іі_____$.  (MEOW)   .
  ______________$_______$$$________$ 	 .        .
  __$$$$$$$$_____$_______$________$ 			.	.	.
  $$______ __$_______$$_________$$
  _$_________$_____$___$$$$$$___$
  ____$______$____$__$________$__$
  ____$_____$____$__$__________$__$
  _ __$____$___$$$$__$__________$__$$$$
  __$___$____$____$__$________$___$___$
  __$__$_____$____$__$________$__$____$
  _$___$______$___ _$__$____$_$__$____$
  ___$__$______$____$___$_$_____$___$
  ____$___$$$$$_$___$___$_$____$___$
  _______$$$$$_$____$____$_____$____$
  _ ____________$$$_$_____$______$_$$$
  __________________$$$$___$$$$$

   -->

  <header class="header">
    <div class="container">
      <div class="row header__wrapper">
        <nav class="header__navbar">

          <?php the_custom_logo(); ?>

          <?php
            wp_nav_menu( [
              'theme_location' => 'header-primary',
              'menu_id'        => 'primary-menu',
              'container' => false,
              'menu_class' => 'header__nav-menu',
              'list_item_class' => 'header__nav-list-item',
              'link_class' 	 	  => 'header__nav-link',
            ] );
          ?>
        </nav>

        <ul class="header__user-cases">
          <li class="header__cart-item">
            <a href="#" class="header__cart-link">
              <?php esc_html_e( 'Vefverslun', 'mst_bodleid' ); ?>
            </a>
          </li>
          <li class="header__user-item">
            <a href="#" class="header__user-link">
              <?php esc_html_e( 'Aðstoð', 'mst_bodleid' ); ?>
            </a>
          </li>
        </ul>
      </div>

      <div class="header__mobile-header row">
        <div class="header__mobile-container">
          <?php the_custom_logo(); ?>

          <div class="hamburger hamburger--squeeze">
            <div class="hamburger-box">
              <div class="hamburger-inner"></div>
            </div>
          </div>
        </div>

        <div class="header__mobile-menu">
          <div class="mobile-menu-wrapper">
            <nav class="header__navbar">
              <?php
              wp_nav_menu( [
                'theme_location' => 'header-primary',
                'menu_id'        => 'primary-menu',
                'container' => false,
                'menu_class' => 'header__nav-menu',
                'list_item_class' => 'header__nav-list-item',
                'link_class' 	 	  => 'header__nav-link',
              ] );
              ?>
            </nav>

            <ul class="header__user-cases">
              <li class="header__cart-item">
                <a href="#" class="header__cart-link">
                  <?php esc_html_e( 'Vefverslun', 'mst_bodleid' ); ?>
                </a>
              </li>
              <li class="header__user-item">
                <a href="#" class="header__user-link">
                  <?php esc_html_e( 'Aðstoð', 'mst_bodleid' ); ?>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
