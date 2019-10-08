<?php
/*
  Template Name: Login page
*/

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() ) {
  wp_redirect( get_permalink( get_page_by_path( 'account' ) ) );
}

get_header();
?>

  <main class="main" id="content" role="main">
    <?php get_template_part( 'components/page/content', 'breadcrumbs' ); ?>

    <section class="login">
      <div class="container">
        <div class="row">
          <div class="login__wrapper">
            <div class="notification"></div>
            <?php
              get_template_part( 'components/account/account', 'login-form' );

              if ( function_exists( 'mst_bodleid_the_sign_up_form' ) ) {
                mst_bodleid_the_sign_up_form( 'registration-page' );
              }
            ?>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php
get_footer();