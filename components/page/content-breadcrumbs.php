<?php
/**
 * Template part for displaying breadcrumbs
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bodleid
 * @since 1.0.0
 */
?>

<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <ol class="breadcrumbs__list" itemscope itemtype="http://schema.org/BreadcrumbList">
        <?php
          if ( function_exists( 'bcn_display_list' ) ) {
            bcn_display_list();
          }
        ?>
      </ol>
    </div>
  </div>
</div>