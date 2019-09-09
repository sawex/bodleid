<?php
/**
 * Template part for displaying homepage about section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 */

$fields = get_fields();
$phone = get_field( 'company_phone_number', 'option' );

$about_fields = $fields['about_us'];
$title = esc_html( $about_fields['title'] );
$text = $about_fields['main_text'];
$left_text = $about_fields['text_under_phone'];
$right_text = $about_fields['text_under_main'];
$brands_gallery = $about_fields['gallery'];
?>

<section class="about">
  <div class="container">
    <div class="row">
      <div class="about__container">
        <div class="about__info">
          <div class="about__desc-box">
            <h2 class="secondary-title about__title">
              <?php echo $title; ?>
            </h2>
            <p class="about__desc text"><?php echo $text; ?></p>
          </div>
          <div class="about__contacts-box">
            <div class="about__main-contacts">
              <a href="tel:<?php echo esc_attr( $phone ); ?>"
                 class="telephone-number">
                <?php echo esc_html( $phone ); ?>
              </a>
              <p class="about__contacts-desc text"><?php echo $left_text; ?></p>
            </div>

            <div class="about__contacts-disclaimer">
              <p class="about__contacts-desc text"><?php echo $right_text; ?></p>
            </div>
          </div>
        </div>

        <div class="about__brands">
          <?php
            if ( is_array( $brands_gallery ) ) {
              foreach ( $brands_gallery as $brand ) {
                $src = esc_url( $brand['sizes']['medium'] );
                $alt = esc_url( $brand['alt'] );
          ?>
                <div class="about__brand">
                  <img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" class="about__brand-img">
                </div>
          <?php
              }
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
