<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 */

defined( 'ABSPATH' ) || exit;
get_header();
?>

  <main class="main" id="content">
    <?php get_template_part( 'template-parts/content', 'banner' ); ?>

    <section class="products">
      <div class="container">
        <div class="row">
          <div class="products__wrapper">
            <?php
              if ( have_posts() ) {
                while ( have_posts() ) {
                  the_post();
                }

                the_content();
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
