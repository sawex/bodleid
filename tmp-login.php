<?php
/*
  Template Name: Login page
*/

defined( 'ABSPATH' ) || exit;
get_header();
?>

  <main class="main">
    <div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <ol class="breadcrumbs__list" itemscope itemtype="http://schema.org/BreadcrumbList">
            <li class="breadcrumbs__list-item itemprop="itemListElement" itemscope
            itemtype="http://schema.org/ListItem">
            <a class="breadcrumbs__link itemprop="item" href="/">
              <span class="breadcrumbs__link-content itemprop="name"></span>
            </a>
            <meta itemprop="position" content="1" />
            </li>

            <li class="breadcrumbs__list-item itemprop="itemListElement" itemscope
            itemtype="http://schema.org/ListItem">
            <a class="breadcrumbs__link itemprop="item" href="/Vefverslun/">
            <span class="breadcrumbs__link-content itemprop="name">Vefverslun</span>
            </a>
            <meta itemprop="position" content="2" />
            </li>
            <li class="breadcrumbs__list-item itemprop="itemListElement" itemscope
            itemtype="http://schema.org/ListItem">
            <a class="breadcrumbs__link itemprop="item" href="/Vefverslun/Reikningurinn/">
            <span class="breadcrumbs__link-content itemprop="name">Reikningurinn</span>
            </a>
            <meta itemprop="position" content="3" />
            </li>
          </ol>
        </div>
      </div>
    </div>

    <section class="login">
      <div class="container">
        <div class="row">
          <div class="login__wrapper">

            <!-- Login form start -->
            <form class="login__form">
              <h3 class="tertiary-title login__title login__title--active">
                <?php esc_html_e( 'Log in', 'mst_bodleid' ); ?>
              </h3>

              <p class="text login__text">
                <?php
                  esc_html_e(
                    'Bidding route offers a complete solution in telephone and online language for small and 
                    large companies and hotels, from telephone networks to internal online affairs and connection 
                    to the world',
                    'mst_bodleid'
                  );
                ?>
              </p>

              <div class="login__input-wrap">
                <div class="form__input-box">
                  <input class="form__input" type="text" name="email" id="email-field">
                  <label class="form__label" for="email-field">
                    <?php esc_html_e( 'Email*', 'mst_bodleid' ); ?>
                  </label>
                </div>

                <div class="form__input-box">
                  <input class="form__input" type="password" name="password" id="password-field">
                  <label class="form__label" for="password-field">
                    <?php esc_html_e( 'Password*', 'mst_bodleid' ); ?>
                  </label>
                </div>
              </div>

              <input class="login__form-btn"
                     value="<?php esc_attr_e( 'Log in', 'mst_bodleid' ); ?>"
                     aria-label="<?php esc_attr_e( 'Log in', 'mst_bodleid' ); ?>"
                     type="submit">

              <input class="login__remember-input" type="checkbox" name="remember-me" id="remember-me-check" checked>
              <label class="login__remember-label" for="remember-me-check">
                <?php esc_html_e( 'Remember me', 'mst_bodleid' ); ?>
              </label>

              <a href="#" class="login__forgotten-password">
                <?php esc_html_e( 'Forgotten password?', 'mst_bodleid' ); ?>
              </a>
            </form>
            <!-- Login form end -->

            <!-- Sign up form end -->
            <form class="login__form login__new-client">
              <h3 class="tertiary-title login__title">
                <?php esc_html_e( 'New customer', 'mst_bodleid' ); ?>
              </h3>

              <p class="text login__text">
                <?php
                esc_html_e(
                  'Bidding route offers a complete solution in telephone and online language for small and 
                    large companies and hotels, from telephone networks to internal online affairs and connection 
                    to the world',
                  'mst_bodleid'
                );
                ?>
              </p>

              <div class="login__new-client-wrap">
                <div class="login__personal-info">
                  <h4 class="login__form-subtitle">
                    <?php esc_html_e( 'Personal information', 'mst_bodleid' ); ?>
                  </h4>

                  <div class="form__input-box">
                    <input class="form__input" type="text" name="name" id="name-field">
                    <label class="form__label" for="name-field">
                      <?php esc_html_e( 'First Name*', 'mst_bodleid' ); ?>
                    </label>
                  </div>

                  <div class="form__input-box">
                    <input class="form__input" type="text" name="extensions" id="extensions-field">
                    <label class="form__label" for="extensions-field">
                      <?php esc_html_e( 'Extensions', 'mst_bodleid' ); ?>
                    </label>
                  </div>

                  <div class="form__input-box">
                    <input class="form__input" type="email" name="email" id="email-field">
                    <label class="form__label" for="email-field">
                      <?php esc_html_e( 'Email*', 'mst_bodleid' ); ?>
                    </label>
                  </div>

                  <div class="form__input-box">
                    <input class="form__input" type="tel" name="phone" id="phone-field">
                    <label class="form__label" for="phone-field">
                      <?php esc_html_e( 'Phone number*', 'mst_bodleid' ); ?>
                    </label>
                  </div>

                  <div class="form__input-box">
                    <input class="form__input" type="password" name="password" id="password-field">
                    <label class="form__label" for="password-field">
                      <?php esc_html_e( 'Create a password*', 'mst_bodleid' ); ?>
                    </label>
                  </div>
                </div>

                <div class="login__address-info">
                  <h4 class="login__form-subtitle">
                    <?php esc_html_e( 'Your address', 'mst_bodleid' ); ?>
                  </h4>

                  <div class="form__input-box">
                    <input class="form__input" type="text" name="company" id="company-field">
                    <label class="form__label" for="company-field">
                      <?php esc_html_e( 'Company', 'mst_bodleid' ); ?>
                    </label>
                  </div>

                  <div class="form__input-box">
                    <input class="form__input" type="text" name="address" id="address-field">
                    <label class="form__label" for="address-field">
                      <?php esc_html_e( 'Address*', 'mst_bodleid' ); ?>
                    </label>
                  </div>

                  <div class="form__input-box">
                    <input class="form__input" type="text" name="city" id="city-field">
                    <label class="form__label" for="city-field">
                      <?php esc_html_e( 'City / Town*', 'mst_bodleid' ); ?>
                    </label>
                  </div>

                  <div class="form__input-box">
                    <input class="form__input" type="text" name="post-number" id="post-number-field">
                    <label class="form__label" for="post-number-field">
                      <?php esc_html_e( 'Post number*', 'mst_bodleid' ); ?>
                    </label>
                  </div>

                  <div class="form__input-box">
                    <input class="form__input" type="text" name="country" id="country-field">
                    <label class="form__label" for="country-field">
                      <?php esc_html_e( 'Country*', 'mst_bodleid' ); ?>
                    </label>
                  </div>

                  <div class="form__input-box form__select-box">
                    <select class="form__input" name="region" id="region-field">
                      <option>Höfuðborgarsvæðið</option>
                      <option>Suðurnes</option>
                      <option>Vesturland</option>
                      <option>Vestfirðir</option>
                      <option>Norðurland vestra</option>
                      <option>Norðurland eystra</option>
                      <option>Austurland</option>
                      <option>Suðurland</option>
                    </select>
                    <label class="form__label" for="region-field">
                      <?php esc_html_e( 'Region*', 'mst_bodleid' ); ?>
                    </label>
                  </div>
                </div>
              </div>

              <input class="login__form-btn"
                     type="submit"
                     value="<?php esc_attr_e( 'Register', 'mst_bodleid' ); ?>"
                     aria-label="<?php esc_attr_e( 'Register', 'mst_bodleid' ); ?>">
            </form>
            <!-- Sign up form end -->

          </div>
        </div>
      </div>
    </section>
  </main>

<!--TODO: use wp_set_auth_cookie() and wp_login_form() -->

<?php
get_footer();