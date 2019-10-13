<?php
/*
  Template Name: About us page
*/

defined( 'ABSPATH' ) || exit;
get_header();

/* @var array $staff */
$staff = get_field( 'staff' );

/* @var string $default_thumbnail */
$default_thumbnail = esc_url( get_field( 'staff_default_userpic', 'option' ) );
?>

  <main class="main" id="content" role="main">
    <?php get_template_part( 'components/page/content', 'banner' ); ?>

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

    <section class="staff" id="staff-section">
      <div class="container">
        <div class="row">
          <div class="staff__wrapper">
            <h2 class="secondary-title staff__title">
              <?php esc_html_e( 'Staff', 'mst_bodleid' ); ?>
            </h2>
            <div class="staff__members">

              <?php
                if ( is_array( $staff ) ) {
                  foreach ( $staff as $person ) {
                    /* @var string $name Person's name */
                    $name = $person['name'];

                    /* @var string $position Person's company / position */
                    $position = esc_html( $person['position'] );

                    /* @var string $email Person's email */
                    $email = $person['email'];

                    /* @var string $photo_src */
                    $photo_src = esc_url( $person['photo']['sizes']['medium'] );

                    /* @var string $photo_alt */
                    $photo_alt = esc_attr( $person['photo']['alt'] );
              ?>

                <div class="staff__member">
                  <div class="staff__member-userpic-box">
                    <?php if ( $photo_src ) { ?>
                      <img src="<?php echo $photo_src; ?>"
                           alt="<?php echo $photo_alt; ?>"
                           class="staff__member-userpic">
                    <?php } else { ?>
                      <img src="<?php echo $default_thumbnail; ?>"
                           alt="<?php echo esc_attr( $name ); ?>"
                           class="staff__member-userpic">
                    <?php } ?>
                  </div>
                  <div class="staff__member-info">
                    <h4 class="staff__member-name"><?php echo esc_html( $name ); ?></h4>
                    <p class="staff__position"><?php echo $position; ?></p>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>"
                       class="staff__email email">
                      <?php echo esc_html( $email ); ?>
                    </a>
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
