<?php
/**
 * Bodleid functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bodleid
 */

if ( ! defined( 'MST_BODLEID_VER' ) ) {
  define( 'MST_BODLEID_VER', '1.0.10' );
}

/**
 * Functions update DB options on ACF fields updating.
 * Uses for DK Tenging plugin
 */
function mst_bodleid_dkplus_update_username( $value ) {
  update_option( 'dk_login', $value );
  return $value;
}

function mst_bodleid_dkplus_update_password( $value ) {
  update_option( 'dk_password', $value );
  return $value;
}

function mst_bodleid_dkplus_update_token( $value ) {
  update_option( 'dk_token', $value );
  return $value;
}

add_filter( 'acf/update_value/name=dkplus_username', 'mst_bodleid_dkplus_update_username', 10, 1 );
add_filter( 'acf/update_value/name=dkplus_password', 'mst_bodleid_dkplus_update_password', 10, 1 );
add_filter( 'acf/update_value/name=dkplus_token', 'mst_bodleid_dkplus_update_token', 10, 1 );

/**
 * Creates custom ACF theme settings page.
 */
function mst_bodleid_register_settings() {
  if ( !function_exists('acf_add_options_page') ) return;

  $parent = acf_add_options_page( [
    'page_title' => __( 'Theme settings', 'mst_bodleid' ),
    'menu_slug' => 'theme-settings',
    'autoload' => true,
  ] );

  acf_add_options_sub_page( [
    'page_title' => 'General Settings',
    'menu_title' => 'General',
    'parent_slug'   => $parent['menu_slug'],
    'menu_slug'     => 'general-settings'
  ] );

  acf_add_options_sub_page( [
    'page_title'    => 'Footer Settings',
    'menu_title'    => 'Footer',
    'parent_slug'   => $parent['menu_slug'],
    'menu_slug'     => 'footer-settings',
  ] );

  acf_add_options_sub_page( [
    'page_title'    => 'Shop Settings',
    'menu_title'    => 'Shop',
    'parent_slug'   => $parent['menu_slug'],
    'menu_slug'     => 'shop-settings',
  ] );

  acf_add_options_sub_page( [
    'page_title'    => 'dkPlus API',
    'menu_title'    => 'dkPlus API',
    'parent_slug'   => $parent['menu_slug'],
    'menu_slug'     => 'dkplus-api-settings',
  ] );
}

add_action('acf/init', 'mst_bodleid_register_settings');

if ( ! function_exists( 'mst_bodleid_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mst_bodleid_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Bodleid, use a find and replace
		 * to change 'mst_bodleid' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mst_bodleid', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'header-primary' => esc_html__( 'Header primary menu', 'mst_bodleid' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;

add_action( 'after_setup_theme', 'mst_bodleid_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mst_bodleid_widgets_init() {
	register_sidebar( [
		'name'          => esc_html__( 'Sidebar', 'mst_bodleid' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mst_bodleid' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	] );
}

add_action( 'widgets_init', 'mst_bodleid_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mst_bodleid_scripts() {
	wp_enqueue_style(
	  'mst_bodleid-bootstrap-css',
    get_template_directory_uri() . '/assets/css/bootstrap-grid.min.css',
    [],
    MST_BODLEID_VER
  );

	wp_enqueue_style(
	  'mst_bodleid-aos-css',
    get_template_directory_uri() . '/assets/css/aos.min.css',
    [],
    MST_BODLEID_VER
  );

	wp_enqueue_style(
	  'mst_bodleid-slick-css',
    get_template_directory_uri() . '/assets/css/slick.css',
    [],
    MST_BODLEID_VER
  );

	wp_enqueue_style( 'mst_bodleid-style', get_stylesheet_uri() );

	wp_enqueue_script(
	  'mst_bodleid-aos-js',
    get_template_directory_uri() . '/assets/js/aos.min.js',
    [],
    MST_BODLEID_VER,
    true
  );

  wp_enqueue_script(
    'mst_bodleid-slick-js',
    get_template_directory_uri() . '/assets/js/slick.min.js',
    ['jquery'],
    MST_BODLEID_VER,
    true
  );

  if ( is_page( 'leidbeiningar' ) ) {
    wp_enqueue_script(
      'mst_bodleid-bigpicture',
      get_template_directory_uri() . '/assets/js/bigpicture.min.js',
      [],
      MST_BODLEID_VER,
      true
    );
  }

  if ( is_page( 'products-comparing' ) ) {
    wp_enqueue_script(
      'mst_bodleid-dragscroll',
      get_template_directory_uri() . '/assets/js/jquery.dragscroll.min.js',
      [],
      MST_BODLEID_VER,
      true
    );
  }

  wp_enqueue_script(
    'mst_bodleid-common',
    get_template_directory_uri() . '/assets/js/common.js',
    ['jquery'],
    MST_BODLEID_VER,
    true
  );

  wp_localize_script(
    'mst_bodleid-common',
    'mainState',
    [
      'ajaxUrl' => admin_url( 'admin-ajax.php' ),
      'accountUrl' => mst_bodleid_get_account_page(),
      'loginUrl' => mst_bodleid_get_login_page(),
      'comparisonUrl' => mst_bodleid_get_comparison_page_url(),
      'i18n' => [
        'inComparisonList' => esc_html__( 'View comparison list', 'mst_bodleid' ),
        'comparingIsEmpty' => esc_html__( 'No products were found matching your selection.', 'woocommerce' ),
        'dataUpdated' => esc_html__( 'Data updated successfully', 'mst_bodleid' ),
        'error_billing_first_name' => esc_html__( 'First name field cannot be empty', 'mst_bodleid' ),
        'error_billing_email' => esc_html__( 'Enter valid email address', 'mst_bodleid' ),
        'error_billing_phone' => esc_html__( 'Phone number can contains digits only and cannot be longer than 12 digits', 'mst_bodleid' ),
        'error_password' => esc_html__( 'Password cannot be empty or shorter than 6 symbols', 'mst_bodleid' ),
        'error_billing_address_1' => esc_html__( 'Address cannot be empty', 'mst_bodleid' ),
        'error_billing_city' => esc_html__( 'City field name cannot be empty', 'mst_bodleid' ),
        'error_billing_postcode' => esc_html__( 'Postcode field cannot be empty', 'mst_bodleid' ),
        'error_passwords_arent_equal' => esc_html__( 'Passwords are not equal', 'mst_bodleid' ),
        'error_billing_ssn' => esc_html__( 'Invalid SSN, please check your input', 'mst_bodleid' ),
      ],
    ]
  );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'mst_bodleid_scripts' );

/**
 * Inserts Google Tag Manager code.
 */
function mst_bodleid_insert_tag_manager_in_head() {
?>

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TC6GKDN');</script>
  <!-- End Google Tag Manager -->

<?php
}

add_action( 'wp_head', 'mst_bodleid_insert_tag_manager_in_head' );

function mst_bodleid_insert_tag_manager_after_body() {
  ?>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TC6GKDN"
                    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <?php
}

add_action( 'wp_body_open', 'mst_bodleid_insert_tag_manager_after_body' );

function mst_bodleid_set_favicons() {
  $fav_folder_path = get_template_directory_uri() . '/assets/images/fav';
  ?>

  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $fav_folder_path; ?>/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $fav_folder_path; ?>/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $fav_folder_path; ?>/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $fav_folder_path; ?>/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $fav_folder_path; ?>/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $fav_folder_path; ?>/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $fav_folder_path; ?>/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $fav_folder_path; ?>/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $fav_folder_path; ?>/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $fav_folder_path; ?>/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $fav_folder_path; ?>/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $fav_folder_path; ?>/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $fav_folder_path; ?>/favicon-16x16.png">
  <link rel="manifest" href="/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?php echo $fav_folder_path; ?>/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

<?php
}

add_action( 'wp_head', 'mst_bodleid_set_favicons' );

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load AJAX handlers.
 */
if ( file_exists( get_template_directory() . '/inc/ajax.php' ) ) {
  require get_template_directory() . '/inc/ajax.php';
}

/**
 * Load SVG icons class.
 */
if ( ! class_exists( 'MST_Bodleid_SVG_Icons' ) ) {
  require get_template_directory() . '/classes/class.MST_Bodleid_SVG_Icons.php';
}

/**
 * Load SVG icons handlers.
 */
if ( file_exists( get_template_directory() . '/inc/svg-icons.php' ) ) {
  require get_template_directory() . '/inc/svg-icons.php';
}

/**
 * Load account handlers.
 */
if ( file_exists( get_template_directory() . '/inc/account.php' ) ) {
  require get_template_directory() . '/inc/account.php';
}

/**
 * Product comparing helpers.
 */
if ( file_exists( get_template_directory() . '/inc/comparing.php' ) ) {
  require get_template_directory() . '/inc/comparing.php';
}

if ( is_admin() ) {
  require get_template_directory() . '/inc/admin.php';
}

/**
 * Set custom logo classes.
 *
 * @param string $html Logo markup
 * @return string $html New logo markup
 */
function mst_bodleid_change_logo_class( $html ) {
  $html = str_replace( 'custom-logo-link', 'header__logo', $html );
  $html = str_replace( 'custom-logo', 'header__logo-img', $html );
  return $html;
}

add_filter( 'get_custom_logo', 'mst_bodleid_change_logo_class' );

/**
 * Set custom nav's <li> and <a> classes.
 */
function mst_bodleid_add_menu_link_class( $atts, $item, $args ) {
  if ( property_exists( $args, 'link_class' ) ) {
    $atts['class'] = $args->link_class;
  }
  return $atts;
}

add_filter( 'nav_menu_link_attributes', 'mst_bodleid_add_menu_link_class', 1, 3 );

function mst_bodleid_add_menu_list_item_class( $classes, $item, $args ) {
  if ( property_exists( $args, 'list_item_class' ) ) {
    $classes[] = $args->list_item_class;
  }
  return $classes;
}

add_filter( 'nav_menu_css_class', 'mst_bodleid_add_menu_list_item_class', 1, 3 );

/**
 * Register custom post types.
 */
function mst_bodleid_register_post_types() {
  register_post_type( 'testimonials', [
    'labels' => [
      'name' => __( 'Testimonials', 'mst_bodleid' ),
      'singular_name' => __( 'Testimonial', 'mst_bodleid' ),
    ],
    'public' => true,
    'has_archive' => true,
    'rewrite' => [ 'slug' => 'testimonials' ],
  ] );

  register_post_type( 'catalogs', [
    'labels' => [
      'name' => __( 'Catalogs', 'mst_bodleid' ),
      'singular_name' => __( 'Catalog', 'mst_bodleid' ),
    ],
    'public' => true,
    'publicly_queryable' => true,
    'has_archive' => true,
    'rewrite' => [ 'slug' => 'catalogs' ],
  ] );
}

add_action( 'init', 'mst_bodleid_register_post_types' );

/**
 * Adds query vars from an array.
 *
 * @param array Query vars to add in format key => value.
 *
 * @return void
 */
function mst_bodleid_add_query_vars( $query_vars ) {
  if ( is_array( $query_vars ) ) {
    foreach ( $query_vars as $query_var_key => $query_var_value ) {
      set_query_var( $query_var_key, $query_var_value );
    }
  }
}

/**
 * Add query vars on page loading.
 */
function mst_bodleid_set_page_query_vars() {
  if ( is_page() && ! is_front_page() || is_singular( 'catalogs' ) ) {
    $fields = get_fields();

    $query_vars = [
      'banner_image' => esc_url( $fields['banner_image'] ),
      'banner_title' => esc_html( $fields['banner_title'] ),
      'banner_text' => esc_html( $fields['banner_text'] ),
      'banner_btn_text' => esc_html( $fields['banner_button']['text'] ),
      'banner_btn_href' => esc_url( $fields['banner_button']['link'] ),
    ];

    if ( function_exists( 'mst_bodleid_add_query_vars' ) ) {
      mst_bodleid_add_query_vars( $query_vars );
    }
  }
}

add_action( 'wp', 'mst_bodleid_set_page_query_vars' );

/**
 * Shuffle returned posts if "_shuffle" parameter equals true.
 *
 * @param array $posts
 * @param object
 *
 * @return array
 */
function mst_bodleid_shuffle_posts( $posts, $query ) {
  if ( $query->get( '_shuffle' ) === true ) {
    shuffle( $posts );
  }

  return $posts;
}

add_filter( 'the_posts', 'mst_bodleid_shuffle_posts', 10, 2 );