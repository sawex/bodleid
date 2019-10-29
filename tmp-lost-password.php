<?php
/*
  Template Name: Lost password page
*/

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() ) {
  wp_redirect( mst_bodleid_get_account_page() );
}

/* @var string $reset_key User account restore key */
$reset_key = $_GET['rk'];

/* @var string $user_id */
$user_id = base64_decode( $_GET['u'] );

/* @var null|WP_User|WP_Error */
$user = null;

if ( ! empty( $reset_key ) && ! empty( $user_id ) ) {
  $login = get_user_by( 'id', $user_id )->user_login;
  $user = check_password_reset_key( $reset_key, $login );
}

get_header();
?>

  <main class="main" id="content" role="main">
    <?php get_template_part( 'components/page/content', 'breadcrumbs' ); ?>

    <section class="login">
      <div class="container">
        <div class="row">
          <div class="woocommerce-notices-wrapper woocommerce-notices-wrapper--forgot-pass"></div>
        </div>

        <?php if ( ! $reset_key || ! $user_id ) { ?>
          <div class="row">
            <div class="login__wrapper">
              <?php get_template_part( 'components/account/form', 'lost-password' ); ?>
            </div>
          </div>
        <?php } ?>

        <?php if ( ! empty( $user ) && ! is_wp_error( $user ) ) { ?>
          <div class="row">
            <div class="login__wrapper">
              <?php get_template_part( 'components/account/form', 'new-password' ); ?>
            </div>
          </div>
        <?php } ?>

        <?php if ( is_wp_error( $user ) ) { ?>
          <div class="row">
            <div class="search__result-title-box" style="margin-bottom: 160px;">
              <h2 class="secondary-title search__result-title">
                <?php esc_html_e( 'URL is invalid or expired, please try again.', 'mst_bodleid' ); ?>
              </h2>
            </div>
          </div>
        <?php } ?>
      </div>
    </section>
  </main>

<?php
get_footer();