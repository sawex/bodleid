<?php
/**
 * Bodleid SVG Icon helper functions
 *
 * @package WordPress
 * @since 1.0.0
 */

if ( ! function_exists('mst_bodleid_the_theme_svg')) {
  /**
   * Output and Get Theme SVG.
   * Output and get the SVG markup for an icon in the TwentyTwenty_SVG_Icons class.
   *
   * @param string $svg_name The name of the icon.
   * @param string $color Color code.
   */
  function mst_bodleid_the_theme_svg($svg_name, $color = '')
  {
    echo mst_bodleid_get_theme_svg($svg_name, $color);
  }
}

if ( ! function_exists('mst_bodleid_get_theme_svg')) {

  /**
   * Get information about the SVG icon.
   *
   * @param string $svg_name The name of the icon.
   * @param string $color Color code.
   *
   * @return string|bool
   */
  function mst_bodleid_get_theme_svg($svg_name, $color = '')
  {

    // Make sure that only our allowed tags and attributes are included.
    $svg = wp_kses(
      MST_Bodleid_SVG_Icons::get_svg($svg_name, $color),
      array(
        'svg' => array(
          'class' => true,
          'xmlns' => true,
          'width' => true,
          'height' => true,
          'viewbox' => true,
          'aria-hidden' => true,
          'role' => true,
          'focusable' => true,
        ),
        'path' => array(
          'fill' => true,
          'fill-rule' => true,
          'd' => true,
          'transform' => true,
          'stroke' => true,
          'stroke-linecap' => true,
          'stroke-linejoin' => true,
          'stroke-miterlimit' => true,
          'stroke-width' => true,
        ),
        'polygon' => array(
          'fill' => true,
          'fill-rule' => true,
          'points' => true,
          'transform' => true,
          'focusable' => true,
        ),
      )
    );

    if ( ! $svg) {
      return false;
    }
    return $svg;
  }
}
