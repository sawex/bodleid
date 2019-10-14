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

/* @var bool $show_banner */
$show_banner = get_field( 'show_banner' );

/* @var bool $show_testimonials */
$show_testimonials = get_field( 'show_testimonials' );

/* @var bool $dark_bg */
$dark_bg = get_field( 'dark_background' );
?>

  <main class="main" id="content" role="main">
    <?php
      if ( $show_banner ) {
        get_template_part( 'components/page/content', 'banner' );
      }
    ?>

    <section class="products <?php echo $dark_bg ? 'bg--black' : ''; ?>">
      <div class="container">
        <div class="row">
          <div class="<?php echo is_cart() ? 'cart' : 'products__wrapper'; ?>">
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

    <?php
      if ( $show_testimonials ) {
        get_template_part( 'components/page/content', 'testimonials' );
      }
    ?>
  </main>

<?php
get_footer();
