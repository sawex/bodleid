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

<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <ol class="breadcrumbs__list" itemscope itemtype="http://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumbs__list-item">
          <a itemprop="item"
             href="<?php echo esc_url( home_url() ); ?>"
             class="breadcrumbs__link breadcrumbs__link--home">
            <span itemprop="name"><?php esc_html_e( 'Home', 'mst_bajk' ); ?></span>
          </a>
          <meta itemprop="position" content="1" />
        </li>

        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breadcrumbs__list-item">
          <a itemprop="item" class="breadcrumbs__link">
            <span itemprop="name">Account</span>
          </a>
          <meta itemprop="position" content="2" />
        </li>

      </ol>
    </div>
  </div>
</div>
