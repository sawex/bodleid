<?php
/**
 * Template part for displaying homepage about section
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 */

/* @var array $fields Page fields */
$fields = get_fields();

/* @var string $phone Company phone from settings */
$phone = get_field( 'company_phone_number', 'option' );

/* @var array $about_fields */
$about_fields = $fields['about_us'];

/* @var string $title */
$title = esc_html( $about_fields['title'] );

/* @var string $text */
$text = wp_kses_post( $about_fields['main_text'] );

/* @var string $left_text */
$left_text = wp_kses_post( $about_fields['text_under_phone'] );

/* @var string $right_text */
$right_text = wp_kses_post( $about_fields['text_under_main'] );

/* @var array $brands_gallery */
$brands_gallery = $about_fields['gallery'];
?>

<section class="about" id="about-section">
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
