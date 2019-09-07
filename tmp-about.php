<?php
/*
  Template Name: About us page
*/

defined( 'ABSPATH' ) || exit;
get_header();

$staff = get_field( 'staff' );
?>

  <main class="main">
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

    <section class="staff">
      <div class="container">
        <div class="row">
          <div class="staff__wrapper">
            <h2 class="secondary-title staff__title"><?php esc_html_e( 'Staff', 'mst_bodleid' ); ?></h2>
            <div class="staff__members">

              <?php
                if ( is_array( $staff ) ) {
                  foreach ( $staff as $person ) {
                    $name = esc_html( $person['name'] );
                    $position = esc_html( $person['position'] );
                    $email = esc_html( $person['email'] );
                    $photo_src = esc_url( $person['photo']['sizes']['medium'] );
                    $photo_alt = esc_attr( $person['photo']['alt'] );
              ?>

                <div class="staff__member">
                  <div class="staff__member-userpic-box">
                    <?php if ( $photo_src ) { ?>
                      <img src="<?php echo $photo_src; ?>"
                           alt="<?php echo $photo_alt; ?>"
                           class="staff__member-userpic">
                    <?php } else { ?>
                      <img src="<?php echo esc_url( get_field( 'staff_default_userpic', 'option' ) ); ?>"
                           alt="<?php echo $name; ?>"
                           class="staff__member-userpic">
                    <?php } ?>
                  </div>
                  <div class="staff__member-info">
                    <h4 class="staff__member-name"><?php echo $name; ?></h4>
                    <p class="staff__position"><?php echo $position; ?></p>
                    <a href="mailto:<?php echo $email; ?>" class="staff__email email"><?php echo $email; ?></a>
                  </div>
                </div>

              <?php
                  }
                }
              ?>

              <div class="staff__member--empty"></div>
              <div class="staff__member--empty"></div>
              <div class="staff__member--empty"></div>
              <div class="staff__member--empty"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php
get_footer();
