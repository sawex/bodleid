<?php
/**
 * Custom icons for this theme.
 *
 * @package Bodleid
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
    public static function get_svg( $icon, $color = '#fff' ) {
      $arr = self::$ui_icons;

      if ( array_key_exists( $icon, $arr ) ) {
        $repl = '<svg class="svg-icon" aria-hidden="true" role="img" focusable="false" ';
        $svg  = preg_replace( '/^<svg /', $repl, trim( $arr[ $icon ] ) ); // Add extra attributes to SVG code.
//        $svg  = str_replace( '#fff', $color, $svg ); // Replace the color.
//        $svg  = str_replace( '#', '%23', $svg ); // Urlencode hashes.
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
      'user' => '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26">
        <path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="50" stroke-width=".7" d="M13 15.42A7.26 7.26 0 1 0 13 .89a7.26 7.26 0 0 0 0 14.53zM.54 25.11a7.1 7.1 0 0 1 7.07-7.07h10.77a7.1 7.1 0 0 1 7.08 7.07"/>
        <path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="50" stroke-width=".7" d="M13 15.42A7.26 7.26 0 1 0 13 .89a7.26 7.26 0 0 0 0 14.53zM.54 25.11a7.1 7.1 0 0 1 7.07-7.07h10.77a7.1 7.1 0 0 1 7.08 7.07"/>
      </svg>',
      'comparison' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="26">
        <path fill="#fff" d="M4.84.17L.17 4.84a.58.58 0 0 0 .82.82L5.67 1a.58.58 0 0 0-.82-.83z"/>
        <path fill="#fff" d="M5.66 9.5L1 4.85a.58.58 0 0 0-.83.82l4.67 4.67a.58.58 0 0 0 .82-.82z"/>
        <path fill="#fff" d="M.58 5.84h18.67a6.42 6.42 0 0 1 6.42 6.41.58.58 0 1 0 1.16 0 7.58 7.58 0 0 0-7.58-7.58H.58a.58.58 0 0 0 0 1.17zM23.17 25.5l4.66-4.67a.58.58 0 0 0-.82-.83l-4.67 4.67a.58.58 0 0 0 .83.82z"/>
        <path fill="#fff" d="M22.34 16.17l4.67 4.66a.58.58 0 0 0 .82-.82l-4.66-4.67a.58.58 0 0 0-.83.83z"/>
        <path fill="#fff" d="M27.42 19.83H8.75a6.42 6.42 0 0 1-6.41-6.42.58.58 0 0 0-1.17 0A7.58 7.58 0 0 0 8.75 21h18.67a.58.58 0 0 0 0-1.17z"/>
      </svg>',
      'cart' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="31">
        <path fill="#fff" d="M23.93 8.91l2.15 18.24a1.91 1.91 0 0 1-1.9 2.14h-21a1.91 1.91 0 0 1-1.9-2.14L3.44 8.91zM27.34 27l-2.2-18.8a.64.64 0 0 0-.64-.56H2.87a.64.64 0 0 0-.64.56L.03 27a3.18 3.18 0 0 0 3.15 3.55h21A3.18 3.18 0 0 0 27.34 27z"/>
        <path fill="#fff" d="M8.6 10.82V6.36a5.1 5.1 0 0 1 10.18 0v4.46a.64.64 0 1 0 1.27 0V6.36a6.36 6.36 0 0 0-12.73 0v4.46a.64.64 0 1 0 1.27 0z"/>
      </svg>',

    ];
  }
}
