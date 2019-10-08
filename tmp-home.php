<?php
/*
  Template Name: Home page
*/

defined( 'ABSPATH' ) || exit;
get_header();
?>

  <main class="main" id="content" role="main">
    <?php
      get_template_part( 'components/home/home', 'banner' );
      get_template_part( 'components/home/home', 'catalogs' );
      get_template_part( 'components/home/home', 'clients' );
      get_template_part( 'components/home/home', 'about' );
      get_template_part( 'components/page/content', 'testimonials' );
    ?>
  </main>

<?php
get_footer();
