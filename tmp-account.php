<?php
/*
  Template Name: Account page
*/

defined( 'ABSPATH' ) || exit;

if ( ! is_user_logged_in() ) {
  wp_redirect( get_permalink( get_page_by_path( 'login' ) ) );
}

get_header();

?>

  <main class="main" id="content" role="main">
    <?php get_template_part( 'components/page/content', 'breadcrumbs' ); ?>

    <section class="account">
      <div class="container">
        <div class="row account_notices">
          <?php do_action( 'mst_bodleid_wc_notices' ); ?>
        </div>

        <div class="row">
          <div class="account__wrapper">
            <nav class="account__navigation">
              <?php get_template_part( 'components/account/account', 'menu' ); ?>
            </nav>

            <?php get_template_part( 'components/account/account', 'orders' ); ?>

            <div class="account-data-container hidden">
              <?php
                if ( function_exists( 'mst_bodleid_the_sign_up_form' ) ) {
                  mst_bodleid_the_sign_up_form( 'account-page' );
                }
              ?>
            </div>

          </div>
        </div>
      </div>
    </section>
  </main>

<?php
get_footer();

