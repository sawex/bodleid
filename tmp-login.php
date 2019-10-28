<?php
/*
  Template Name: Login page
*/

defined( 'ABSPATH' ) || exit;

/* @var string $account_page */
$account_page = esc_url( get_permalink( get_page_by_path( 'account' ) ) );

if ( is_user_logged_in() ) {
  wp_redirect( $account_page );
}

get_header();
?>

  <main class="main" id="content" role="main">
    <?php get_template_part( 'components/page/content', 'breadcrumbs' ); ?>

    <section class="login">
      <div class="container">
        <div class="row account-notices">
          <div class="woocommerce-notices-wrapper">
            <div class="woocommerce-message woocommerce-message--hidden woocommerce-message--login-page"
                 role="alert">
              <button class="w-close-btn"
                      aria-label="<?php esc_html_e( 'Close alert', 'mst_bodleid' ); ?>">
              </button>
              <p class="woocommerce-message__text"></p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="login__wrapper">
            <?php
              if ( function_exists( 'mst_bodleid_the_login_form' ) ) {
                mst_bodleid_the_login_form( false, true, $account_page  );
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