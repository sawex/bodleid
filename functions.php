<?php
/**
 * Bodleid functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bodleid
 */

if ( ! defined( 'MST_BODLEID_VER' ) ) {
  define( 'MST_BODLEID_VER', '1.0.0' );
}

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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'mst_bodleid_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

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
    get_template_directory_uri() . '/css/bootstrap-grid.min.css',
    [],
    MST_BODLEID_VER
  );

	wp_enqueue_style(
	  'mst_bodleid-aos-css',
    get_template_directory_uri() . '/css/aos.min.css',
    [],
    MST_BODLEID_VER
  );

	wp_enqueue_style(
	  'mst_bodleid-slick-css',
    get_template_directory_uri() . '/css/slick.css',
    [],
    MST_BODLEID_VER
  );

	wp_enqueue_style( 'mst_bodleid-style', get_stylesheet_uri() );

	wp_enqueue_script(
	  'mst_bodleid-aos-js',
    get_template_directory_uri() . '/js/aos.min.js',
    [],
    MST_BODLEID_VER,
    true
  );

  wp_enqueue_script(
    'mst_bodleid-slick-js',
    get_template_directory_uri() . '/js/slick.min.js',
    ['jquery', 'mst_bodleid-common'],
    MST_BODLEID_VER,
    true
  );

  wp_enqueue_script(
    'mst_bodleid-common',
    get_template_directory_uri() . '/js/common.js',
    ['jquery'],
    MST_BODLEID_VER,
    true
  );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mst_bodleid_scripts' );

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
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
 * Register AJAX handler for callback forms
 */
function mst_bodleid_handleCallback() {
  try {
    $name = $_POST['data']['name'] ?: '-';
    $email = $_POST['data']['email'] ?: '-';
    $phone = $_POST['data']['phone'] ?: '-';
    $description = $_POST['data']['description'] ?: '-';

    wp_mail(
      get_option( 'admin_email' ),
      'На сайте заполнена новая форма',
      "Имя: $name \n Email: $email \n Телефон: $phone \n Описание задачи: $description"
    );

    wp_send_json_success( [ 'status' => 'OK' ] );

  } catch ( Exception $e ) {
    wp_send_json_error( [ 'error' => $e ] );
  }
}

add_action( 'wp_ajax_mst_bodleid_cb', 'mst_bodleid_handleCallback' );
add_action( 'wp_ajax_nopriv_mst_bodleid_cb', 'mst_bodleid_handleCallback' );

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
 * Set Icelandic locale instead of en_US
 */
function mst_bodleid_set_locale() {
  return 'is_IS';
}

add_filter( 'locale', 'mst_bodleid_set_locale' );

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