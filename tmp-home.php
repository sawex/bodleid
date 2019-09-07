<?php

/*
  Template Name: Home page
*/

defined( 'ABSPATH' ) || exit;
get_header();

$fields = get_fields();
?>

  <main class="main" id="content">
    <?php get_template_part( 'template-parts/home', 'banner' ); ?>

    <section class="catalog">
      <div class="container">
        <div class="row catalog__wrapper">
          <h2 class="secondary-title catalog__title">
            <?php esc_html_e( 'Catalog', 'mst_bodleid' ); ?>
          </h2>
          <div class="catalog__item-positions">
            <ul class="catalog__categories-list">

              <li class="catalog__category-list-item">
                <a href="#" class="catalog__category-link">
                  <img src="images/category-img-telephone.png" alt="#" class="catalog__category-img">
                  <h3 class="tertiary-title catalog__category-title">Símtæki</h3>
                  <p class="catalog__category-desc text">Gæða símtæki frá Yealink</p>
                </a>
              </li>

            </ul>
          </div>
        </div>
      </div>
    </section>

    <?php get_template_part( 'template-parts/home', 'clients' ); ?>

    <section class="about">
      <div class="container">
        <div class="row">
          <div class="about__container">
            <div class="about__info">
              <div class="about__desc-box">
                <h2 class="secondary-title about__title">Við veitum frábæra þjónustu</h2>
                <p class="about__desc text">Starfsmenn þjónustudeildar Boðleiðar hafa áratuga reynslu í þjónustu á símabúnaði og símalausnum. Þjónustumenn hafa farið reglulega á námskeið hjá framleiðendum búnaðar sem Boðleið flytur inn og selur. Ekki þarf að tíunda mikilvægi þess að tæknimenn séu vel að sér og þekki inn á búnaðinn og alla eiginleika hans. Tæknimenn okkar sjá um uppsetningu á símkerfum, tölvunetum, þráðlausum lausnum, uppsetningu beina fyrir gögn og tal, talhólfakerfi, CTI hugbúnað (samtenging síma og tölvu), Contact Center þjónustuvers hugbúnað, rannsóknartæki svo eitthvað sé nefnt. Veitum einnig ráðgjöf og gerum úttekt á fjarskiptamálum fyrirtækja. Þjónustusamningar. Eins og allir vita er forsenda þess að reka fyrirtæki og stunda viðskipti í nútímaþjóðfélagi að samskipti fyrirtækisins séu í lagi og þar spilar símstöðin stórt hlutverk. Þjónustusamningar okkar tryggja að fyrirtæki fái lausn þeirra mála sem upp koma eins fljótt og unnt er, ásamt því að veittur er fastur afsláttur af vörum og þjónustu.</p>
              </div>
              <div class="about__contacts-box">
                <div class="about__main-contacts">
                  <a href="tel:535-5200" class="telephone-number">535-5200</a>
                  <p class="about__contacts-desc text">Þjónustudeild Boðleiðar er opin alla virka daga frá kl 9:00 til 17:00.</p>
                </div>

                <div class="about__contacts-disclaimer">
                  <p class="about__contacts-desc text"> Allar nánari upplýsingar hjá sölumönnum okkar í síma 535-5200. Útkallsþjónusta er allan sólahringinn í aðalsíma Boðleiðar 535-5200. Einnig er hægt að senda okkur þjónustubeiðni á netfangið</p>
                  <a href="mailto:thjonusta@bodleid.is" class="email">thjonusta@bodleid.is</a>
                </div>
              </div>
            </div>

            <div class="about__brands">
              <div class="about__brand"><img src="images/3cx3.png" alt="" class="about__brand-img"></div>
              <div class="about__brand"><img src="images/simaverid.png" alt="" class="about__brand-img"></div>
              <div class="about__brand"><img src="images/global-call2.png" alt="" class="about__brand-img"></div>
              <div class="about__brand"><img src="images/yealink.png" alt="" class="about__brand-img"></div>
              <div class="about__brand"><img src="images/plantronics-logo.png" alt="" class="about__brand-img"></div>
              <div class="about__brand"><img src="images/Jabra.png" alt="" class="about__brand-img"></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php get_template_part( 'template-parts/content', 'testimonials' ); ?>
  </main>

<?php
get_footer();
