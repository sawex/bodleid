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

  <div class="main" style="min-height: 60vh;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 style="color: #fff;">
            <?php esc_html_e( '404. Page not found.', 'mst_bodleid' ); ?>
          </h1>

          <a class="banner__link" href="<?php echo esc_url( home_url() ); ?>">
            <?php esc_html_e( 'Go home', 'mst_bodleid' ); ?>
          </a>
        </div>
      </div>
    </div>
  </div>

<?php
get_footer();
