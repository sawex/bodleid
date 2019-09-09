<?php
/*
  Template Name: Home page
*/

defined( 'ABSPATH' ) || exit;
get_header();
?>

  <main class="main" id="content">
    <?php get_template_part( 'template-parts/home', 'banner' ); ?>
    <?php get_template_part( 'template-parts/home', 'catalogs' ); ?>
    <?php get_template_part( 'template-parts/home', 'clients' ); ?>
    <?php get_template_part( 'template-parts/home', 'about' ); ?>
    <?php get_template_part( 'template-parts/content', 'testimonials' ); ?>
  </main>

<?php
get_footer();
