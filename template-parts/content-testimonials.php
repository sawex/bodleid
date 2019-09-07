<?php
/**
 * Template part for displaying testimonials slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 */

?>

<section class="testimonials">
  <div class="container">
    <div class="row">
      <div class="testimonials__container">
        <h2 class="secondary-title testimonials__title">
          <?php esc_html_e( 'Customer Reviews', 'mst_bodleid' ); ?>
        </h2>
        <div class="testimonials__buttons"></div>
      </div>

      <div class="testimonials__reviews">
        <?php
          $wp_query = new WP_Query( [
            'posts_per_page' => '6',
            'post_type' => 'testimonials',
          ] );

          if ( $wp_query->have_posts() ) {
            while ( $wp_query->have_posts() ) {
              $wp_query->the_post();
              $fields = get_fields();

              $name = esc_html( $fields['author_name'] );
              $company = esc_html( $fields['company_name'] );
              $text = $fields['text'];
              $userpic_src = esc_html( $fields['author_image']['url'] );
        ?>

          <div class="testimonials__review">
            <div class="testimonials__author">
              <img src="<?php echo $userpic_src; ?>" alt="" class="testimonials__author-img">
            </div>
            <div class="testimonials__review-text">
              <p class="testimonials__comment text"><?php echo $text; ?></p>
              <h4 class="quaternary-title testimonials__author-name"><?php echo $name; ?></h4>
              <p class="testimonials__company-name text"><?php echo $company; ?></p>
            </div>
          </div>

        <?php
            }
            wp_reset_query();
          }
        ?>
      </div>
    </div>
  </div>
</section>
