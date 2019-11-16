<?php
/**
 * Template part for displaying page banner
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 * @since 1.0.0
 */
?>

<section class="instructions-banner">
  <div class="container">
    <div class="row">
      <div class="instructions-banner__banner-bg"
           style="background-image: url('<?php echo $banner_image; ?>');">
      </div>

      <div class="instructions-banner__banner-info">

        <?php if ( $banner_title ) { ?>
          <h1 class="secondary-title instructions-banner__title"><?php echo $banner_title; ?></h1>
        <?php } ?>

        <div class="instructions-banner__banner-desc">
          <?php if ( $banner_text ) { ?>
            <p class="text instructions-banner__banner-text"><?php echo $banner_text; ?></p>
          <?php } ?>

          <?php if ( $banner_btn_href ) { ?>
            <a href="<?php echo $banner_btn_href; ?>"
               class="instructions-banner__banner-link banner__link">
              <?php echo $banner_btn_text; ?>
            </a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
