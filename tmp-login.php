<?php
/*
  Template Name: Login page
*/

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() ) {
  wp_redirect( mst_bodleid_get_account_page() );
}

get_header();
?>

  <main class="main" id="content" role="main">
    <?php get_template_part( 'components/page/content', 'breadcrumbs' ); ?>

    <section class="login">
      <div class="container">
       <div class="row">
          <div class="login__wrapper">
            <?php
              if ( function_exists( 'mst_bodleid_the_login_form' ) ) {
                mst_bodleid_the_login_form( false, true, $account_page );
              }

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