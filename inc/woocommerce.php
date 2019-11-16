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
		$fragments['a.header__cart-link'] = ob_get_clean();

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
    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>"
       class="header__cart-link">
      <?php mst_bodleid_the_theme_svg( 'cart' ); ?>
      <span class="quantity-product-circle"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
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
remove_all_actions( 'woocommerce_before_single_product' );
add_action( 'mst_bodleid_wc_notices', 'wc_print_notices', 10 );
remove_all_actions( 'woocommerce_before_single_product_summary' );
remove_all_actions( 'woocommerce_after_single_product_summary' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/**
 * Remove single-product tabs
 *
 * @param array $tabs Single product tabs
 *
 * @return array Updated product tabs
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
 * Remove WooCommerce breadcrumbs.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * Add single-product quantity buttons.
 */
function mst_bodleid_add_qty_plus_btn() {
 echo '<button class="one-product__btn one-product__btn--plus">+</button>';
}

function mst_bodleid_add_qty_minus_btn() {
 echo '<button class="one-product__btn one-product__btn--minus">-</button>';
}

add_action( 'woocommerce_after_add_to_cart_quantity', 'mst_bodleid_add_qty_plus_btn' );
add_action( 'woocommerce_before_add_to_cart_quantity', 'mst_bodleid_add_qty_minus_btn' );

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
 * Returns product html by its id.
 *
 * @param int $id Product id
 * @param string $node Product wrapper HTML element
 *
 * @return void
 */
function mst_bodleid_the_product_html( $id = null, $node = 'li', $title_level = 'h4' ) {
  global $product;

  if ( empty( $id ) ) {
    $id = $product->get_id();
  }

  $product_cart_id = WC()->cart->generate_cart_id( $id );
  $in_cart = WC()->cart->find_product_in_cart( $product_cart_id );
  $in_comparison = mst_bodleid_is_product_in_comparison_list( $id );

  $product = wc_get_product( $id );

  if ( empty( $product ) || ! $product->is_visible() ) {
    return null;
  }

  $id = esc_html( $product->get_id() );
  $title = esc_html( $product->get_title() );
  $sku = esc_html( $product->get_sku() );
  $is_in_stock = esc_html( $product->is_in_stock() );
  $desc = wp_kses_post( wp_trim_words( $product->get_short_description(), 15, '...' ) );
  $price = wp_kses_post( $product->get_price_html() );
  $url = $product->get_permalink();
  $post_thumbnail_id = $product->get_image_id();
  $image_url = esc_url( wp_get_attachment_image_src( $post_thumbnail_id, 'medium' )[0] );
  $add_to_cart_url = esc_url( $product->add_to_cart_url() );
  $wp_placeholder_img = esc_url( wc_placeholder_img_src() );
  ?>

  <<?php echo $node; ?> class="product-item <?php echo $in_comparison ? 'header__user-list--active ' : ''; ?>"
                        data-id="<?php echo $id; ?>">
    <a href="<?php echo $url; ?>" class="product-link" style="height: initial;">
      <div class="product-img-box">
        <img src="<?php echo $image_url ?: $wp_placeholder_img; ?>"
             alt="<?php echo $title; ?>"
             class="product-img">
      </div>

      <div class="product-info">
        <?php printf( '<%1$s>%2$s<%1$s>', esc_html( $title_level ), $title ); ?>
        <p><?php echo $desc; ?></p>
      </div>
    </a>

    <div class="product-price">
      <?php echo $price; ?>
      <button class="compare-btn <?php echo $in_comparison ? 'compare-btn--active ' : ''; ?>"></button>
    </div>

  <?php if ( ! $is_in_stock ) { ?>
    <div class="to-cart-box">
      <a href="<?php echo $url; ?>"
         class="add-to-cart-btn">
        <?php esc_html_e( 'View product', 'woocommerce' ); ?>
      </a>
    </div>
  <?php } ?>

  <?php if ( ! $in_cart && $is_in_stock ) { ?>
    <div class="to-cart-box">
      <?php //woocommerce_template_loop_add_to_cart( [ 'class' => 'add-to-cart-btn ajax_add_to_cart' ] ); ?>
      <a href="<?php echo $add_to_cart_url; ?>"
         data-quantity="1"
         class="add-to-cart-btn ajax_add_to_cart"
         data-product_id="<?php echo $id; ?>"
         data-product_sku="<?php echo $sku; ?>"
         aria-label="Add “<?php echo $title; ?>” to your cart"
         rel="nofollow">
        <?php esc_html_e( 'Add to cart', 'woocommerce' ); ?>
      </a>
    </div>
  <?php } else if ( $in_cart && $is_in_stock ) { ?>
    <div class="to-cart-box to-cart-box--added">
      <a href="<?php echo wc_get_cart_url(); ?>" class="add-to-cart-btn">
        <?php esc_html_e( 'View cart', 'woocommerce' ); ?>
      </a>
    </div>
  <?php } ?>

  </<?php echo $node; ?>>

  <?php
}

/**
 * Remove hooks from cart.php
 */
remove_all_actions( 'woocommerce_cart_collaterals' );
remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message' );
add_filter('woocommerce_add_message', '__return_false');

/**
 * ARCHIVE
 * */

/**
 * Remove hooks from archive-product.php
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
remove_action( 'woocommerce_after_main_content', 'woocommerce_after_main_content' );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 20 );

/**
 * Add woocommerce-shop class to the /shop page
 *
 * @param array $classes HTML <body> classes
 * @return array Updated classes
 */
function mst_bodleid_add_shop_class( $classes ) {
  if ( is_shop() ) {
    $classes[] = 'woocommerce-shop';
  }

  return $classes;
}

add_filter( 'body_class', 'mst_bodleid_add_shop_class' );

/**
 * CHECKOUT
 * */

/**
 * Remove hooks from checkout.
 */
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

/**
 * Sets custom thank-you page to redirect after success checkout.
 *
 * @param int $order_id Order id
 */
function mst_bodleid_thank_you_redirect( $order_id ) {
  $order = wc_get_order( $order_id );

  $thank_you_page_url = esc_url( get_permalink( get_page_by_path( 'order' ) ) );
  $order_url = esc_url( add_query_arg( [ 'order_id' => $order_id ], $thank_you_page_url ) );

  if ( ! $order->has_status( 'failed' ) ) {
    wp_safe_redirect( $order_url );
    exit;
  }
}

add_action( 'woocommerce_thankyou', 'mst_bodleid_thank_you_redirect' );

/**
 * Add classes to checkout inputs and labels.
 *
 * @param array $fields Checkout fields
 *
 * @return array Updated checkout fields
 */
function mst_bodleid_checkout_fields_styling( $fields ) {
  // Fields removing
  unset( $fields['billing']['billing_state'] );
  unset( $fields['billing']['billing_address_2'] );
  unset( $fields['billing']['billing_last_name'] );

  // Fields order updating
  $fields['billing']['billing_postcode']['priority'] = 70;
  $fields['billing']['billing_city']['priority'] = 65;

  // Fields placeholder removing
  unset( $fields['order']['order_comments']['placeholder'] );
  unset( $fields['account']['account_password']['placeholder'] );

  // Change label
  $fields['order']['order_comments']['label'] = esc_html__( 'Any wishes, reference ...', 'mst_bodleid' );

  return $fields;
}

add_filter( 'woocommerce_checkout_fields' , 'mst_bodleid_checkout_fields_styling' );

/**
 * Removes address placeholder.
 *
 * @param array $fields Default fields
 *
 * @return array Updated default fields
 */
function mst_bodleid_default_checkout_fields( $fields ) {
  unset( $fields['address_1']['placeholder'] );

  return $fields;
}

add_filter( 'woocommerce_default_address_fields', 'mst_bodleid_default_checkout_fields', 10, 1 );

/**
 * Add password field to checkout billing form for new users.
 */
update_option( 'woocommerce_registration_generate_password', 'no' );

/**
 * Removes password strength meter from checkout.
 */
function mst_bodleid_remove_password_strength() {
  if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
    wp_dequeue_script( 'wc-password-strength-meter' );
  }
}

add_action( 'wp_print_scripts', 'mst_bodleid_remove_password_strength', 100 );

/**
 * Validate SSN when user tries to place order.
 * SSN must contains only 10 digits and cannot be empty.
 *
 * Update user SSN on checkout.
 */
function mst_bodleid_validate_ssn() {
  $ssn = filter_input( INPUT_POST, 'billing_ssn' );
  $ssn = preg_replace( '/[^0-9]/', '', $ssn );

  if ( empty( $ssn ) || ! preg_match( '~^\d{10}$~', $ssn ) ) {
    wc_add_notice( __( 'Invalid <strong>SSN</strong>, please check your input.', 'mst_bodleid' ), 'error' );
  } else {
    if ( is_user_logged_in() ) {
      update_user_meta( get_current_user_id(), 'billing_ssn', $ssn );
    }
  }
}

add_action( 'woocommerce_checkout_process', 'mst_bodleid_validate_ssn', 10, 2 );

/**
 * Change Valitor gateway to simple no-payment gateway for users
 * with role "Supercustomer".
 *
 * @param array $gateways
 *
 * @return array
 */
function mst_bodleid_update_supercustomers_payment_gateway( $gateways ) {
  if ( wc_user_has_role( get_current_user_id(), 'supercustomer' ) ) {
    unset( $gateways['valitor'] );
  } else {
    unset( $gateways['mst_cod'] );
  }

  return $gateways;
}

add_filter( 'woocommerce_available_payment_gateways', 'mst_bodleid_update_supercustomers_payment_gateway', 1 );

/**
 * EMAIL
 */

/**
 * @param WC_Order $order Order Object
 * @param bool $sent_to_admin If this email is for administrator or for a customer
 * @param string $plain_text HTML or Plain text (can be configured in WooCommerce > Settings > Emails)
 */
function mst_bodleid_add_ssn_to_emails( $order, $sent_to_admin, $plain_text ) {
  $ssn = get_post_meta( $order->get_id(), 'billing_ssn', true );

  if ( empty( $ssn ) ) return;

  if ( ! $plain_text ) {
    printf( '<h2>Additional Information</h2><ul><li><strong>SSN:</strong>%s</li></ul>', $ssn );
  } else {
    echo "Additional Information\n
		SSN: $ssn";
  }
}

add_action( 'woocommerce_email_order_meta', 'mst_bodleid_add_ssn_to_emails', 10, 3 );


/**
 * MISC
 */

/**
 * Init WC session for unlogged users.
 */
add_action( 'woocommerce_init', function() {
  if ( WC()->session ) {
    if ( ! WC()->session->has_session() ) {
      WC()->session->set_customer_session_cookie( true );
    }
  }
} );

/**
 * Always allow backorders for every product.
 */
add_filter( 'woocommerce_product_is_in_stock', '__return_true', 10, 2 );
add_filter( 'woocommerce_product_backorders_allowed', '__return_true', 10, 3 );
add_filter( 'woocommerce_product_backorders_require_notification', '__return_true', 10, 2 );

/**
 * Allow Shop Managers to edit and promote users with the Super Customer role
 * using the ‘woocommerce_shop_manager_editable_roles’ filter.
 *
 * @param array $roles Array of role slugs for users Shop Managers can edit.
 * @return array
 */
function mst_bodleid_shop_manager_role_edit_capabilities( $roles ) {
  $roles[] = 'supercustomer';
  return $roles;
};

add_filter( 'woocommerce_shop_manager_editable_roles', 'mst_bodleid_shop_manager_role_edit_capabilities' );

/**
 * All WC prices correct rounding.
 *
 * @param float $price Price to round
 *
 * @return float
 */
function mst_bodleid_round_price_product( $price ) {
  return round( $price );
}

add_filter( 'woocommerce_get_price_including_tax', 'mst_bodleid_round_price_product', 10 );
add_filter( 'wc_cart_totals_subtotal_html', 'mst_bodleid_round_price_product', 10 );
add_filter( 'woocommerce_product_get_price', 'mst_bodleid_round_price_product', 10 );
