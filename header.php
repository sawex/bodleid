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

  <header class="header">
    <div class="container">
      <div class="row header__wrapper">
        <nav class="header__navbar">

          <?php the_custom_logo(); ?>

          <?php
            wp_nav_menu( [
              'theme_location' => 'header-primary',
              'menu_id' => 'primary-menu',
              'container' => false,
              'menu_class' => 'header__nav-menu',
              'list_item_class' => 'header__nav-list-item',
              'link_class' => 'header__nav-link',
            ] );
          ?>
        </nav>

        <?php get_template_part( 'components/header/header', 'second-menu' ); ?>
      </div>

      <div class="header__mobile-header row">
        <div class="header__mobile-container">
          <?php the_custom_logo(); ?>

          <?php get_template_part( 'components/header/header', 'second-menu' ); ?>

          <button class="hamburger hamburger--squeeze">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
        </div>

        <div class="header__mobile-menu">
          <div class="mobile-menu-wrapper">
            <nav class="header__navbar">
              <?php
              wp_nav_menu( [
                'theme_location' => 'header-primary',
                'menu_id' => 'primary-menu',
                'container' => false,
                'menu_class' => 'header__nav-menu',
                'list_item_class' => 'header__nav-list-item',
                'link_class' => 'header__nav-link',
              ] );
              ?>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
