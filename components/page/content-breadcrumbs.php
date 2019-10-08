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

<!--<div class="breadcrumbs">-->
<!--  <div class="container">-->
<!--    <div class="row">-->
<!--      <ol class="breadcrumbs__list" itemscope itemtype="http://schema.org/BreadcrumbList">-->
<!--        <li class="breadcrumbs__list-item itemprop="itemListElement" itemscope-->
<!--        itemtype="http://schema.org/ListItem">-->
<!--          <a class="breadcrumbs__link itemprop="item" href="/">-->
<!--            <span class="breadcrumbs__link-content" itemprop="name"></span>-->
<!--            <span property="itemListElement" typeof="ListItem">-->
<!--              <a property="item" typeof="WebPage" title="Go to %title%." href="%link%" class="%type%" bcn-aria-current>-->
<!--                <span property="name">%htitle%</span></a>-->
<!--              <meta property="position" content="%position%">-->
<!--            </span>-->
<!--          </a>-->
<!--         <meta itemprop="position" content="1" />-->
<!--        </li>-->
<!---->
<!--        <li class="breadcrumbs__list-item itemprop="itemListElement" itemscope-->
<!--        itemtype="http://schema.org/ListItem">-->
<!--        <a class="breadcrumbs__link itemprop="item" href="/Vefverslun/">-->
<!--        <span class="breadcrumbs__link-content itemprop="name">Vefverslun</span>-->
<!--        </a>-->
<!--        <meta itemprop="position" content="2" />-->
<!--        </li>-->
<!---->
<!--        <li class="breadcrumbs__list-item itemprop="itemListElement" itemscope-->
<!--        itemtype="http://schema.org/ListItem">-->
<!--        <a class="breadcrumbs__link itemprop="item" href=" /Vefverslun/Reikningurinn/">-->
<!--        <span class="breadcrumbs__link-content itemprop="name">Reikningurinn</span>-->
<!--        </a>-->
<!--        <meta itemprop="position" content="3" />-->
<!--        </li>-->
<!--      </ol>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
