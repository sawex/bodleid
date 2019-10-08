<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bodleid
 */

/* @var string $footer_image */
$footer_image = esc_url( get_field( 'footer_image', 'option' ) );

/* @var string $footer_copyright */
$footer_copyright = wp_kses_post( get_field( 'footer_copyright', 'option' ) );

/* @var string $footer_title */
$footer_title = esc_html( get_field( 'footer_content_title', 'option' ) );

/* @var string $footer_desc */
$footer_desc = wp_kses_post( get_field( 'footer_description', 'option' ) );

/* @var string $address */
$address = esc_html( get_field( 'company_address', 'option' ) );

/* @var string $phone */
$phone = get_field( 'company_phone_number', 'option' );

/* @var string $email */
$email = get_field( 'company_email', 'option' );
?>

<footer class="footer" id="main-footer">
  <div class="container">
    <div class="row">
      <div class="footer__wrapper">
        <div class="footer__image-box">
          <?php if ( $footer_image ) { ?>
            <img src="<?php echo $footer_image; ?>" class="footer__img" alt="">
          <?php } ?>
        </div>

        <address class="footer__contacts">
          <?php if ( $address ) { ?>
            <a href="#" class="tertiary-title footer__address"><?php echo $address; ?></a>
          <?php } ?>

          <?php if ( $phone ) { ?>
            <a href="tel:<?php echo esc_attr( $phone ); ?>" class="telephone-number">
              <?php echo esc_html( $phone ); ?>
            </a>
          <?php } ?>

          <p class="footer__contacts-desc text">
            <?php esc_html_e( 'Service requests send to:', 'mst_bodleid' ); ?>
          </p>

          <?php if ( $email ) { ?>
            <a href="mailto:<?php echo esc_attr( $email ); ?>" class="email"><?php echo esc_attr( $email ); ?></a>
          <?php } ?>
        </address>
      </div>

      <div class="footer__appoint-meeting">
        <div class="footer__meeting-desc">
          <?php if ( $footer_title ) { ?>
            <h2 class="secondary-title"><?php echo $footer_title; ?></h2>
          <?php } ?>

          <?php if ( $footer_desc ) { ?>
            <div class="fake-list">
              <p class="text footer__meeting-text"><?php echo $footer_desc; ?></p>
            </div>
          <?php } ?>
        </div>

        <?php get_template_part( 'components/footer/footer', 'form' ); ?>

      </div>

      <div class="footer__copyright">
        <?php if ( $footer_copyright ) { ?>
          <span class="footer__copy"><?php echo $footer_copyright; ?></span>
        <?php } ?>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>