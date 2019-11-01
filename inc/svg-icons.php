<?php
/**
 * Bodleid SVG Icon helper functions
 *
 * @package WordPress
 * @since 1.0.0
 */

if ( ! function_exists('mst_bodleid_the_theme_svg') ) {
  /**
   * Output and Get Theme SVG.
   * Output and get the SVG markup for an icon in the TwentyTwenty_SVG_Icons class.
   *
   * @param string $svg_name The name of the icon.
   *
   * @return void <svg> element.
   */
  function mst_bodleid_the_theme_svg( $svg_name ) {
    echo mst_bodleid_get_theme_svg( $svg_name );
  }
}

if ( ! function_exists('mst_bodleid_get_theme_svg') ) {

  /**
   * Get information about the SVG icon.
   *
   * @param string $svg_name The name of the icon.
   *
   * @return string|bool
   */
  function mst_bodleid_get_theme_svg( $svg_name ) {

    // Make sure that only our allowed tags and attributes are included.
    $svg = wp_kses(
      MST_Bodleid_SVG_Icons::get_svg( $svg_name ),
      array(
        'svg' => [
          'class' => true,
          'xmlns' => true,
          'width' => true,
          'height' => true,
          'viewbox' => true,
          'aria-hidden' => true,
          'role' => true,
          'focusable' => true,
        ],
        'path' => [
          'fill' => true,
          'fill-rule' => true,
          'd' => true,
          'transform' => true,
          'stroke' => true,
          'stroke-linecap' => true,
          'stroke-linejoin' => true,
          'stroke-miterlimit' => true,
          'stroke-width' => true,
        ],
        'polygon' => [
          'fill' => true,
          'fill-rule' => true,
          'points' => true,
          'transform' => true,
          'focusable' => true,
        ],
      )
    );

    if ( ! $svg ) {
      return false;
    }

    return $svg;
  }
}
