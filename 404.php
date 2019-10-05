<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Bodleid
 */

get_header();
?>

  <main class="main">
    <section class="page-404">
      <div class="container">
        <div class="row">
          <div class="page-404__desc">
            <h2 class="secondary-title page-404__title">
              <?php esc_html_e( 'Page not found', 'mst_bodleid' ); ?>
            </h2>
            <p class="text page-404__text">
              <?php esc_html_e( 'We apologize, but no page is found on this URL.', 'mst_bodleid' ); ?>
            </p>
            <a href="<?php echo esc_url( home_url() ); ?>" class="page-404__to-home-link">
              <?php esc_html_e( 'Go to the front page', 'mst_bodleid' ); ?>
            </a>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php
get_footer();
