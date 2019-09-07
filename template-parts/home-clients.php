<?php
/**
 * Template part for displaying clients slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 */

$clients_gallery = get_field('clients_slider');

?>

<section class="clients">
  <div class="container">
    <div class="row">

      <div class="clients__container">
        <h3 class="tertiary-title clients__title">
          <?php esc_html_e( 'Our clients', 'mst_bodleid' ) ?>
        </h3>
        <div class="clients__carousel-buttons"></div>
      </div>

      <div class="clients__carousel-container">
        <div class="clients__list">
          <?php
          if ( is_array( $clients_gallery ) ) {
            foreach ( $clients_gallery as $client ) {
              $src = esc_url( $client['sizes']['medium'] );
              $alt = esc_url( $client['alt'] );
              ?>
              <div class="clients__list-item">
                <img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" class="clients__logo-img">
              </div>
              <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
