<?php
/**
 * Template part for displaying page banner
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 * @since 1.0.0
 */

/* @var array $slider_images */
$slider_images = get_field( 'slider_images', 'option' );

/* @var string $slider_button_title */
$slider_button_title = esc_html( get_field( 'slider_button', 'option' )['title'] );

/* @var string $slider_button_url */
$slider_button_url = esc_url( get_field( 'slider_button', 'option' )['url'] );

/* @var string $shop_title */
$shop_title = esc_html( get_field( 'shop_title', 'option' ) );

/* @var string $shop_text */
$shop_text = wp_kses_post( get_field( 'shop_text', 'option' ) );
?>

<section class="custom-banner" id="custom-banner">
  <div class="container">
    <div class="row">
      <div class="custom-banner__slider-wrapper">
        <div class="custom-banner__slider">
          <?php
            if ( ! empty( $slider_images ) ) {
              foreach ( $slider_images as $slider_image ) {
                ?>
                  <img src="<?php echo esc_url( $slider_image ); ?>" alt="" class="custom-banner__slider-img">
                <?php
              }
            }
          ?>
        </div>
        <a href="<?php echo $slider_button_url; ?>" class="custom-banner__link">
          <?php echo $slider_button_title; ?>
        </a>
        <nav class="custom-banner__navbar">
          <ul class="custom-banner__nav-list">
<!--            <li class="custom-banner__nav-list-item">-->
<!--              <button class="custom-banner__nav-btn custom-banner__nav-btn--active"></button>-->
<!--            </li>-->
<!--            <li class="custom-banner__nav-list-item">-->
<!--              <button class="custom-banner__nav-btn"></button>-->
<!--            </li>-->
<!--            <li class="custom-banner__nav-list-item">-->
<!--              <button class="custom-banner__nav-btn"></button>-->
<!--            </li>-->
          </ul>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="shop__text-wrap">
        <h2 class="secondary-title custom-title"><?php echo $shop_title; ?></h2>
        <p class="custom-text"><?php echo $shop_text; ?></p>
      </div>
    </div>
  </div>
</section>

