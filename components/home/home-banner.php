<?php
/**
 * Template part for displaying homepage banner
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 */

/* @var array $fields Page fields */
$fields = get_fields();

/* @var array $header_banner_fields Banner fields */
$header_banner_fields = $fields['header_banner'];

/* @var string $banner_title  */
$banner_title = wp_kses_post( $header_banner_fields['main_title'] );

/* @var string $banner_subtitle  */
$banner_subtitle = wp_kses_post( $header_banner_fields['subtitle'] );

/* @var string $banner_bg_desk Desktop background image url */
$banner_bg_desk = esc_url( $header_banner_fields['background_image_desk'] );

/* @var string $banner_bg_mobile Mobile background image url */
$banner_bg_mobile = esc_url( $header_banner_fields['background_image_mobile'] );

/* @var string $banner_button_title */
$banner_button_title = esc_html( $header_banner_fields['button']['title'] );

/* @var string $banner_button_title */
$banner_button_href = esc_url( $header_banner_fields['button']['url'] );
?>

<style>
  @media screen and (min-width: 768px) {
    .banner__title::after {
      background-image: url('<?php echo $banner_bg_desk; ?>');
    }
  }

  @media screen and (max-width: 768px) {
    .banner__title::before {
      background-image: url('<?php echo $banner_bg_mobile; ?>');
    }
  }
</style>

<section class="banner" id="home-banner">
  <div class="container">
    <div class="row">
      <div class="banner__desc-container">
        <h1 class="primary-title banner__title"><?php echo $banner_title; ?></h1>
        <p class="banner__desc"><?php echo $banner_subtitle; ?></p>
        <a href="<?php echo $banner_button_href; ?>" class="banner__link"><?php echo $banner_button_title; ?></a>
      </div>
    </div>
  </div>
</section>
