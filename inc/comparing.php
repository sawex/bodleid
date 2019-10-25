<?php
/**
 * Product comparing helpers
 *
 * @link https://codex.wordpress.org/AJAX
 *
 * @package Bodleid
 */

/**
 * Add page-comparison class to the comparison page
 *
 * @param array $classes HTML <body> classes
 * @return array Updated classes
 */
function mst_bodleid_add_comparison_class( $classes ) {
  if ( is_page_template( 'tmp-comparing.php' ) ) {
    $classes[] = 'page-comparison';
  }

  return $classes;
}

add_filter( 'body_class', 'mst_bodleid_add_comparison_class' );

if ( ! function_exists( 'mst_bodleid_comparison_products_count' ) ) {
  /**
   * Returns count of products in comparison list
   *
   * @return int
   */
  function mst_bodleid_comparison_products_count() {
    return count( (array) WC()->session->get( 'mst_bodleid_comparing_list' ) );
  }
}

if ( ! function_exists( 'mst_bodleid_is_product_in_comparison_list' ) ) {
  /**
   * Returns true if product is in comparison list, returns false elsewhere.
   *
   * @param $product_id int
   *
   * @return bool
   */
  function mst_bodleid_is_product_in_comparison_list( $product_id ) {
    $list = WC()->session->get( 'mst_bodleid_comparing_list' );

    if ( in_array( $product_id, $list ) ) {
      return true;
    }

    return false;
  }
}

function mst_bodleid_get_comparison_page_url() {
  $url = esc_url( get_permalink( get_page_by_path( 'products-comparing' ) ) );
  return $url ?: null;
}

