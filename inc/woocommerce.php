<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Bodleid
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function mst_bodleid_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
//	add_theme_support( 'wc-product-gallery-zoom' );
//	add_theme_support( 'wc-product-gallery-lightbox' );
//	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'mst_bodleid_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function mst_bodleid_woocommerce_scripts() {
	wp_enqueue_style( 'mst_bodleid-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'mst_bodleid-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'mst_bodleid_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function mst_bodleid_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'mst_bodleid_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function mst_bodleid_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'mst_bodleid_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function mst_bodleid_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'mst_bodleid_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function mst_bodleid_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'mst_bodleid_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function mst_bodleid_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'mst_bodleid_woocommerce_related_products_args' );

if ( ! function_exists( 'mst_bodleid_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function mst_bodleid_woocommerce_product_columns_wrapper() {
		$columns = mst_bodleid_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'mst_bodleid_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'mst_bodleid_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function mst_bodleid_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'mst_bodleid_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'mst_bodleid_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function mst_bodleid_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'mst_bodleid_woocommerce_wrapper_before' );

if ( ! function_exists( 'mst_bodleid_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function mst_bodleid_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'mst_bodleid_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'mst_bodleid_woocommerce_header_cart' ) ) {
			mst_bodleid_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'mst_bodleid_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function mst_bodleid_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		mst_bodleid_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'mst_bodleid_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'mst_bodleid_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function mst_bodleid_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'mst_bodleid' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'mst_bodleid' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'mst_bodleid_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function mst_bodleid_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php mst_bodleid_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

/**
 * Remove hooks from content-single-product.php
 */
remove_all_actions( 'woocommerce_before_single_product_summary' );
remove_all_actions( 'woocommerce_after_single_product_summary' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/**
 * Remove single-product tabs
 */
function mst_bodleid_remove_product_tabs( $tabs ) {
  unset( $tabs['description'] );          // Remove the description tab
  unset( $tabs['reviews'] );          // Remove the reviews tab
  unset( $tabs['additional_information'] );   // Remove the additional information tab
  return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'mst_bodleid_remove_product_tabs', 98 );

/**
 * Remove single-product sidebar
 */
function mst_bodleid_remove_sidebar_product_pages() {
  if ( is_product() ) {
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
  }
}

add_action( 'wp', 'mst_bodleid_remove_sidebar_product_pages' );

/**
 * Remove WooCommerce breadcrumbs
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

/**
 * Add single-product quantity buttons
 */

function mst_bodleid_add_qty_plus_btn() {
 echo '<button class="one-product__btn one-product__btn--plus">+</button>';
}

function mst_bodleid_add_qty_minus_btn() {
 echo '<button class="one-product__btn one-product__btn--minus">-</button>';
}

add_action( 'woocommerce_before_add_to_cart_quantity', 'mst_bodleid_add_qty_plus_btn' );
add_action( 'woocommerce_after_add_to_cart_quantity', 'mst_bodleid_add_qty_minus_btn' );

/**
 * Limit WooCommerce Short Description Field
 *
 * @param string $short_desc Short description
 *
 * @return string
 */
function mst_bodleid_woocommerce_short_description( $short_desc ) {
  if ( is_product() ) {
    $short_desc = wp_trim_words( $short_desc, 15, '...' );
  }

  return $short_desc;
};

add_filter( 'woocommerce_short_description', 'mst_bodleid_woocommerce_short_description' );

/**
 * Returns product html by its id
 *
 * @param int $id Product id
 * @param string $node Product wrapper HTML element
 *
 * @return void
 */
function mst_bodleid_the_product_html( $id, $node = 'li' ) {
  $product = wc_get_product( $id );

  if ( empty( $product ) ) {
    return null;
  }

  $title = esc_html( $product->get_title() );
  $desc = wp_kses_post( wp_trim_words( $product->get_short_description(), 15, '...' ) );
  $price = wp_kses_post( $product->get_price_html() );
  $url = $product->get_permalink();
  $post_thumbnail_id = $product->get_image_id();
  $image_url = esc_url( wp_get_attachment_image_src( $post_thumbnail_id, 'medium' )[0] );

  ?>

  <<?php echo $node; ?> class="product-item">
    <a href="<?php echo $url; ?>" class="product-link">
      <div class="product-img-box">
        <img src="<?php echo $image_url; ?>" alt="#" class="product-img">
      </div>

      <div class="product-info">
        <h4><?php echo $title; ?></h4>
        <p><?php echo $desc; ?></p>
      </div>

      <div class="product-price">
        <?php echo $price; ?>
        <button class="compare-btn"></button>
      </div>

    </a>
    <div class="to-cart-box">
      <a href="<?php echo $url; ?>" class="add-to-catr-bnt">Setja í körfu</a>
    </div>
  </<?php echo $node; ?>>

  <?php
}

/**
 * Remove hooks from cart.php
 */

remove_all_actions( 'woocommerce_cart_collaterals' );