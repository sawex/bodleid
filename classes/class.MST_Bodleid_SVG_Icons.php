<?php
/**
 * Custom icons for this theme.
 *
 * @package WordPress
 * @since 1.0.0
 */

if ( ! class_exists( 'MST_Bodleid_SVG_Icons' ) ) {
  /**
   * SVG ICONS CLASS
   * Retrieve the SVG code for the specified icon. Based on a solution in Twenty Twenty.
   */
  class MST_Bodleid_SVG_Icons {
    /**
     * GET SVG CODE
     * Get the SVG code for the specified icon
     *
     * @param string $icon Icon name.
     * @param string $color Color.
     *
     * @return string|null
     */
    public static function get_svg( $icon, $color = '#1A1A1B' ) {
      $arr = self::$ui_icons;

      if ( array_key_exists( $icon, $arr ) ) {
        $repl = '<svg class="svg-icon" aria-hidden="true" role="img" focusable="false" ';
        $svg  = preg_replace( '/^<svg /', $repl, trim( $arr[ $icon ] ) ); // Add extra attributes to SVG code.
        $svg  = str_replace( '#1A1A1B', $color, $svg ); // Replace the color.
        $svg  = str_replace( '#', '%23', $svg ); // Urlencode hashes.
        $svg  = preg_replace( "/([\n\t]+)/", ' ', $svg ); // Remove newlines & tabs.
        $svg  = preg_replace( '/>\s*</', '><', $svg ); // Remove white space between SVG tags.
        return $svg;
      }

      return null;
    }

    /**
     * ICON STORAGE
     * Store the code for all SVGs in an array.
     *
     * @var array
     */
    public static $ui_icons = [
      'arrow-down' => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="24" viewBox="0 0 22 24">
		<polygon fill="#FFF" points="721.105 856 721.105 874.315 728.083 867.313 730.204 869.41 719.59 880 709 869.41 711.074 867.313 718.076 874.315 718.076 856" transform="translate(-709 -856)"/>
		</svg>',
      'arrow-down-circled ' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
		<path fill="#FFF" fill-rule="evenodd" d="M16,32 C7.163444,32 0,24.836556 0,16 C0,7.163444 7.163444,0 16,0 C24.836556,0 32,7.163444 32,16 C32,24.836556 24.836556,32 16,32 Z M16.7934656,8 L15.4886113,8 L15.4886113,21.5300971 L10.082786,16.1242718 L9.18181515,17.0407767 L16.1410384,24 L23.1157957,17.0407767 L22.1915239,16.1242718 L16.7934656,21.5300971 L16.7934656,8 Z"/>
		</svg>',
    ];
  }
}
