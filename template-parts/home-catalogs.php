<?php
/**
 * Template part for displaying homepage banner
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 */

$catalogs = get_field( 'catalogs' );
?>

<section class="catalog">
  <div class="container">
    <div class="row catalog__wrapper">
      <h2 class="secondary-title catalog__title">
        <?php esc_html_e( 'Catalog', 'mst_bodleid' ); ?>
      </h2>
      <div class="catalog__item-positions">
        <ul class="catalog__categories-list">
          <?php
            $wp_query = new WP_Query( [
              'posts_per_page' => -1,
              'post_type' => 'catalogs',
              'post__in' => $catalogs,
            ] );

            if ( $wp_query->have_posts() ) {
              while ( $wp_query->have_posts() ) {
                $wp_query->the_post();
                $fields = get_fields();

                $title = esc_html( get_the_title() );
                $desc = esc_html( $fields['catalog_description'] );
                $image_src = esc_url( $fields['catalog_image']['sizes']['medium'] );
                $image_alt = esc_attr( $fields['catalog_image']['alt'] );
                $url = esc_url( get_permalink() );
                ?>
                <li class="catalog__category-list-item">
                  <a href="<?php echo $url; ?>" class="catalog__category-link">
                    <img src="<?php echo $image_src; ?>" alt="<?php echo $image_alt; ?>" class="catalog__category-img">
                    <h3 class="tertiary-title catalog__category-title"><?php echo $title; ?></h3>
                    <p class="catalog__category-desc text"><?php echo $desc; ?></p>
                  </a>
                </li>
                <?php
              }
              wp_reset_query();
            }?>
        </ul>
      </div>
    </div>
  </div>
</section>
