<?php
/*
  Template Name: Instructions page
*/

defined( 'ABSPATH' ) || exit;
get_header();

$instructions = get_field( 'instructions' );
?>

  <main class="main" id="content">
    <?php get_template_part( 'template-parts/content', 'banner' ); ?>

    <section class="main-instructions">
      <div class="container">
        <div class="row">
          <div class="main-instructions__wrapper">

            <?php
              if ( is_array( $instructions ) ) {
                foreach ( $instructions as $instruction_section ) {
                  $desc = $instruction_section['description'];
                  $videos = $instruction_section['videos'];
                  $docs = $instruction_section['documents'];

                  $title = esc_html( $desc['title'] );
                  $text = esc_html( $desc['description'] );
            ?>
            <div class="main-instructions__direction main-instructions__direction--3cx">
              <div class="main-instructions__desc main-instructions__desc--3cx">
                <h3 class="tertiary-title main-instructions__desc-title"><?php echo $title; ?></h3>

                <?php if ( isset( $text ) ) { ?>
                  <div class="fake-list main-instructions__desc-text">
                    <p class="text"><?php echo $text; ?></p>
                  </div>
                <?php } ?>

                <?php
                  if ( is_array( $videos ) ) {
                    foreach ( $videos as $video ) {
                      $title = esc_html( $video['title'] );
                      $thumb_src = esc_url( $video['thumbnail'] );
                      $video_src = esc_url( $video['video'] );
                ?>
                  <div class="main-instructions__videos">
                    <a href="<?php echo $video_src; ?>" class="main-instructions__video">
                      <div class="main-instructions__vedeo-preview-box">
                        <img src="<?php echo $thumb_src; ?>" alt="" class="main-instructions__vedeo-preview">
                      </div>
<!--                      <button class="play-btn"></button>-->
                      <span class="main-instructions__video-name"><?php echo $title; ?></span>
                    </a>
                  </div>
                <?php
                    }
                  }
                ?>
              </div>

              <div class="main-instructions__files">
                <?php
                  if ( is_array( $docs ) ) {
                    foreach ( $docs as $doc ) {
                      $title = esc_html( $doc['title'] );
                      $href = esc_url( $doc['document'] );
                ?>
                  <a href="<?php echo $href; ?>" class="main-instructions__file"><?php echo $title; ?></a>
                <?php
                    }
                  }
                ?>
              </div>
            </div>
            <?php
                }
            }
            ?>
          </div>
        </div>
      </div>
    </section>

    <?php get_template_part( 'template-parts/content', 'testimonials' ); ?>
  </main>


<?php
get_footer();
