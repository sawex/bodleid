<?php
/**
 * Template part for displaying homepage banner
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 */

$fields = get_fields();

$header_banner_fields = $fields['header_banner'];
$banner_title = $header_banner_fields['main_title'];
$banner_subtitle = $header_banner_fields['subtitle'];
$banner_bg_desk = esc_url( $header_banner_fields['background_image_desk'] );
$banner_bg_mobile = esc_url( $header_banner_fields['background_image_mobile'] );
$banner_button_title = esc_html( $header_banner_fields['button']['title'] );
$banner_button_href = esc_html( $header_banner_fields['button']['url'] );
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

<section class="banner">
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
