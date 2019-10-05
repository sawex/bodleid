<?php
/*
  Template Name: Home page
*/

defined( 'ABSPATH' ) || exit;
get_header();
?>

  <main class="main" id="content">
    <?php get_template_part( 'components/home', 'banner' ); ?>
    <?php get_template_part( 'components/home', 'catalogs' ); ?>
    <?php get_template_part( 'components/home', 'clients' ); ?>
    <?php get_template_part( 'components/home', 'about' ); ?>
    <?php get_template_part( 'components/content', 'testimonials' ); ?>
  </main>

<?php
get_footer();
