<?php
/*
  Template Name: Instructions page
*/

defined( 'ABSPATH' ) || exit;
get_header();

/* @var array $instructions */
$instructions = get_field( 'instructions' );
?>

  <main class="main" id="content" role="main">
    <?php get_template_part( 'components/content', 'banner' ); ?>

    <section class="main-instructions">
      <div class="container">
        <div class="row">
          <div class="main-instructions__wrapper">

            <?php
              if ( is_array( $instructions ) ) {
                foreach ( $instructions as $instruction_section ) {
                  /* @var array $desc */
                  $desc = $instruction_section['description'];

                  /* @var array $videos */
                  $videos = $instruction_section['videos'];

                  /* @var array $docs */
                  $docs = $instruction_section['documents'];

                  /* @var string $title */
                  $title = esc_html( $desc['title'] );

                  /* @var string $text */
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
                      /* @var string $title */
                      $title = esc_html( $video['title'] );

                      /* @var string $thumb_src */
                      $thumb_src = esc_url( $video['thumbnail'] );

                      /* @var string $video_src */
                      $video_src = esc_url( $video['video'] );
                ?>
                  <div class="main-instructions__videos">
                    <a href="<?php echo $video_src; ?>" class="main-instructions__video">
                      <div class="main-instructions__vedeo-preview-box">
                        <!--TODO: class="main-instructions__vedeo-preview" -->
                        <img src="<?php echo $thumb_src; ?>" alt="" class="main-instructions__vedeo-preview">
                      </div>

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
                      /* @var string $title */
                      $title = esc_html( $doc['title'] );

                      /* @var string $href */
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

    <?php get_template_part( 'components/content', 'testimonials' ); ?>
  </main>


<?php
get_footer();
