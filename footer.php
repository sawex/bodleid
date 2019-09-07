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

$footer_image = esc_url( get_field( 'footer_image', 'option' ) );
$footer_copyright = get_field( 'footer_copyright', 'option' );
?>

<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="footer__wrapper">
        <div class="footer__image-box">
          <?php if ( isset( $footer_image ) ) { ?>
            <img src="<?php echo $footer_image; ?>" class="footer__img" alt="">
          <?php } ?>
        </div>

        <address class="footer__contacts">
          <a href="#" class="tertiary-title footer__address">Akralind 8, 201 Kópavogi</a>
          <a href="tel:535-5200" class="telephone-number">535-5200</a>
          <p class="footer__contacts-desc text">Þjónustu beiðnir senda á:</p>
          <a href="mailto:thjonusta@bodleid.is" class="email">thjonusta@bodleid.is</a>
        </address>
      </div>

      <div class="footer__appoint-meeting">
        <div class="footer__meeting-desc">
          <h2 class="secondary-title">Panta fund</h2>
          <div class="fake-list">
            <p class="text footer__meeting-text">Við mætum á svæðið, gerum greiningu á þörfum hvers viðskiptavinar og í framhaldi gefum við verð í lausn sem er sérsniðin að þörfum viðkomandi. Heimsóknin er án allra skuldbindinga og kostar ekkert!</p>
          </div>
        </div>

        <form class="form">
          <input class="form__input" type="text" name="name" placeholder="Nafn">
          <input class="form__input" type="tel" name="phone-number" placeholder="Sími">
          <input class="form__input" type="email" name="email" placeholder="Netfang">
          <input class="form__input" type="text" name="company" placeholder="Fyrirtæki">
          <textarea class="form__message" name="message" placeholder="Skilaboð"></textarea>
          <input class="form__submit-btn" type="submit" value="Senda">
        </form>
      </div>

      <div class="footer__copyright">
        <?php if ( isset( $footer_copyright ) ) { ?>
          <span class="footer__copy"><?php echo $footer_copyright; ?></span>
        <?php } ?>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>