<?php
/**
 * The template for displaying search form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Bodleid
 */
?>

<form role="search"
      action="<?php echo get_permalink( get_page_by_path( 'shop' ) ); ?>"
      method="GET"
      class="search__form">
  <label for="search" class="search__form-label">
    <input type="search"
           name="s"
           id="search"
           class="search__form-input"
           placeholder="<?php esc_attr_e( 'Search for...', 'mst_bodleid' ) ?>"
           value="<?php echo get_search_query(); ?>">
    <input type="hidden"
           name="post_type"
           value="product">

    <button type="submit"
            class="search__button"
            aria-label="<?php esc_attr_e( 'Search', 'mst_bodleid' ) ?>">
    </button>
  </label>
</form>