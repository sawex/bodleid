/* global jQuery, AOS, mainState */

import Abstract from './modules/classes/abstract.js';
import Account from './modules/classes/account.js';
import Comparing from './modules/classes/comparing.js';

import smoothAnchors from './modules/mst/smooth-anchors.js';
import validateForm from './modules/mst/form-validation.js';

/**
* @constructor
* */
const Main = function() {
  Abstract.apply(this, arguments);

  // Header
  this.hambButton = document.querySelector('.hamburger');
  this.mobileMenu = document.querySelector('.header__mobile-menu');
  this.mobileMenuWrapper = document.querySelector('.mobile-menu-wrapper');

  // Footer
  this.footerForm = document.querySelector('form.form');
  this.formInputs = document.querySelectorAll('.form__input');
  this.footerFormErrorMessage = document.querySelector('.form__error');
  this.footerFormSuccessMessage = document.querySelector('.form__success');

  // Instructions
  this.instructionVideoLinks = document.querySelectorAll('.main-instructions__video');

  // Cart
  this.quantityContainers = document.querySelectorAll('.product-quantity');
  this.quantityInputs = document.querySelectorAll('.qty');

  // Shop
  this.shopSliderContainer = document.querySelector('.custom-banner__slider');
  this.shopSidebar = document.querySelector('.widget_product_categories');

  this.catalogProductWrappers = document.querySelectorAll('.category-product__product-list');
};

Main.prototype = Object.create(Abstract.prototype);
Main.prototype.constructor = Main;

Main.prototype.smoothAnchors = smoothAnchors;

Main.prototype.setAnimations = function() {
  if (typeof AOS === 'function') {
    AOS.init();
  }
};

Main.prototype.initHamburgerMenu = function() {
  this.hambButton.addEventListener('click', () => {
    this.hambButton.classList.toggle('is-active');
    this.mobileMenu.classList.toggle('header__mobile-menu--visible');
    this.mobileMenuWrapper.classList.toggle('mobile-menu-wrapper--pos');
  });
};

Main.prototype.fixCatalogsTitle = function() {
  const title = document.querySelector('.catalog__title, .widget_product_categories h2');

  if (title && title.innerText.trim() === 'Vöruflokkar') {
    title.innerHTML = 'Vöru<span style="margin-right: 1.1px;">f</span>lokkar';
  }
};

Main.prototype.initVideoViewer = function() {
  if (this.instructionVideoLinks.length && typeof BigPicture === 'function') {
    this.instructionVideoLinks.forEach((link) => {
      link.addEventListener('click', (e) => {
        e.preventDefault();

        BigPicture({
          el: link,
          vidSrc: link.href,
        });
      });
    });
  }
};

Main.prototype.setClientsSlider = function() {
  if (typeof jQuery === 'function') {
    jQuery('.clients__list').slick({
      prevArrow: '',
      nextArrow: '',
      dots: true,
      appendDots: jQuery('.clients__carousel-buttons'),
      customPaging() {
        return '<button class="clients__carousel-btn"></button>';
      },
      slidesToShow: 6,
      slidesToScroll: 6,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 4,
          }
        },
        {
          breakpoint: 575,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
          }
        }
      ],
    });
  }
};

Main.prototype.setTestimonialsSlider = function() {
  if (typeof jQuery === 'function') {
    jQuery('.testimonials__reviews').slick({
      prevArrow: '',
      nextArrow: '',
      dots: true,
      appendDots: jQuery('.testimonials__buttons'),
      customPaging: function (slider, i) {
        if (i < 10) {
          i = `0${i + 1}`;
        }
        return `<button class="testimonials__btn" data-count="${i}"></button>`;
      },
      slidesToShow: 2,
      slidesToScroll: 2,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
        {
          breakpoint: 575,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          }
        }
      ],
    });
  }
};

Main.prototype.initFooterForm = function() {
  this.footerForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const isValid = validateForm(e.target, {
      fields: {
        name: (value) => {
          return (
            /^[ÁáÐðÉéÍíÓóÚúÝýÞþÆæÖöA-Za-z\s]+$/.test(value.trim()) &&
            value.trim().length &&
            value.trim().length <= 20
          );
        },
        phone: (value) => {
          return (
            /^[0-9]+$/.test(value.trim()) &&
            value.trim().length &&
            value.trim().length <= 12
          );
        },
        email: (value) => /\S+@\S+\.\S+/.test(value),
        company: (value) => value.trim().length && value.trim().length <= 20,
        message: (value) => value.trim().length <= 200,
      }
    });

    if (isValid.result) {
      const self = this;

      jQuery.ajax({
        type: 'POST',
        url: mainState.ajaxUrl,
        data: {
          action: 'mst_bodleid_cb',
          data: isValid.data,
        },
        success() {
          self.footerForm.remove();
          self.footerFormSuccessMessage.classList.remove('hidden');
        },
      });
    } else {
      this.highlightInvalidFields(this.formInputs, isValid.invalidFields);

      if (this.footerFormErrorMessage) {
        this.footerFormErrorMessage.classList.add('form__error--is-active');
      }
    }
  });
};

Main.prototype.setFormFloatedLabels = function() {
  const checkLabel = (input) => {
    if (!input.value) {
      input.classList.remove('form__input-filled');
    } else {
      input.classList.add('form__input-filled');
    }
  };

  this.formInputs.forEach((input) => {
    // Check if values are on page loading (e.g. if user wrote something in input and reloaded page)
    checkLabel(input);

    input.addEventListener('change', () => {
      checkLabel(input);
    });
  });
};

Main.prototype.setCartInputButtons = function() {
  if (!this.isCart) return;

  const updateQuantity = () => {
    setTimeout(() => jQuery('[name="update_cart"]').trigger('click'), 1200);
  };

  document.addEventListener('click', (e) => {
    const el = e.target;

    if (el.classList.contains('one-product__btn--plus')) {
      e.preventDefault();

      const newValue = parseInt(el.previousElementSibling.children[1].value) + 1;
      el.previousElementSibling.children[1].value = newValue;

      if (document.querySelector('button[name="update_cart"]')) {
        document.querySelector('button[name="update_cart"]').disabled = false;
      }

      updateQuantity();
    }

    if (el.classList.contains('one-product__btn--minus')) {
      e.preventDefault();

      const newValue = parseInt(el.nextElementSibling.children[1].value) - 1;

      if (newValue <= 0) {
        el.nextElementSibling.children[1].value = 0;
        return;
      }

      el.nextElementSibling.children[1].value = newValue;

      if (document.querySelector('button[name="update_cart"]')) {
        document.querySelector('button[name="update_cart"]').disabled = false;
      }

      updateQuantity();
    }

  });

  this.quantityInputs.forEach((input) => {
    input.addEventListener('change', () => {
      if (parseInt(input.value) === 0) {
        input.parentElement.nextElementSibling.classList.add('one-product__btn--inactive');
      } else {
        input.parentElement.nextElementSibling.classList.remove('one-product__btn--inactive');
      }
    });
  });
};

Main.prototype.fixCheckoutNotice = function() {
  if (!this.isCheckout) return;

  jQuery(document.body).on('checkout_error', function() {
    const $notice = jQuery('.woocommerce-NoticeGroup-checkout').detach();
    jQuery($notice).appendTo('.woocommerce-notices-wrapper--checkout');

    $notice.removeClass( "woocommerce-NoticeGroup woocommerce-NoticeGroup-checkout" ).addClass('woocommerce-message');
    $notice.attr('role', 'alert');

    jQuery('ul.woocommerce-message').removeClass('woocommerce-message woocommerce-message--error').attr('role', '');

    jQuery(jQuery('.w-close-btn').detach()).appendTo('.woocommerce-message');

    setTimeout(() => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    }, 500);
  });
};

Main.prototype.initShopSlider = function() {
  if (!this.shopSliderContainer) return;

  jQuery('.custom-banner__slider').slick({
    arrows: false,
    dots: true,
    appendDots: jQuery('.custom-banner__nav-list'),
    customPaging: function (slider, i) {
      if (i < 10) {
        i = `0${i + 1}`;
      }
      return `<button class="custom-banner__nav-btn" data-count="${i}"></button>`;
    },
  });
};

Main.prototype.setSingleInputButtons = function() {
  if (!this.isSingle) return;

  const plusBtn = document.querySelector('.one-product__btn--plus');
  const minusBtn = document.querySelector('.one-product__btn--minus');

  if (plusBtn) {
    plusBtn.addEventListener('click', (e) => {
      e.preventDefault();

      const el = e.target;
      const newValue = parseInt(el.previousElementSibling.children[1].value) + 1;

      el.previousElementSibling.children[1].value = newValue;
    });
  }

  if (minusBtn) {
    minusBtn.addEventListener('click', (e) => {
      e.preventDefault();

      const el = e.target;
      const newValue = parseInt(el.nextElementSibling.children[1].value) - 1;

      if (newValue <= 0) {
        el.nextElementSibling.children[1].value = 1;
        return;
      }

      el.nextElementSibling.children[1].value = newValue;
    });

  }
};

Main.prototype.setCloseModalButton = function() {
  document.addEventListener('click', (e) => {
    if (e.target.classList.contains('w-close-btn')) {
      e.target.parentElement.remove();
    }
  });
};

Main.prototype.setSingleProductGallery = function() {
 if (!this.isSingle) return;

 const gallery = document.querySelector('.one-product__product-gallery');

 if (gallery) {
   jQuery('.one-product__open-img').slick({
     slidesToShow: 1,
     slidesToScroll: 1,
     arrows: false,
     fade: true,
     asNavFor: '.one-product__product-gallery'
   });

   jQuery('.one-product__product-gallery').slick({
     slidesToShow: 3,
     slidesToScroll: 1,
     asNavFor: '.one-product__open-img',
     dots: false,
     centerMode: true,
     focusOnSelect: true
   });
 }
};

Main.prototype.initShopSidebar = function() {
  if (!this.shopSidebar) return;

  const currentCat = document.querySelector('li.current-cat');
  const parentCats = document.querySelectorAll('li.cat-parent > a');

  if (currentCat) {
    currentCat.classList.add('cat-parent--active');
  }

  parentCats.forEach((cat) => {
    cat.addEventListener('click', (e) => {
      e.preventDefault();

      cat.parentElement.classList.toggle('cat-parent--active');
    });
  });

  const title = document.querySelector('.widget_product_categories .widget-title');

  if (title) {
    const toggleMobileSidebar = () => {
      const list = document.querySelector('.widget_product_categories .product-categories');

      if (list) {
        if (list.style.display === '' || list.style.display === 'none') {
          list.style.display = 'block';
        } else {
          list.style.display = 'none';
        }
      }
    };

    if (window.matchMedia('(max-width: 992px)').matches) {
      title.addEventListener('click', toggleMobileSidebar);
    }

    window.addEventListener('resize', () => {
      if (window.matchMedia('(max-width: 992px)').matches) {
        title.addEventListener('click', toggleMobileSidebar);
      } else {
        title.removeEventListener('click', toggleMobileSidebar);
      }
    });
  }
};

Main.prototype.initAddToCartAJAX = function(e) {
  const btns = document.querySelectorAll('.ajax_add_to_cart');

  if (btns.length) {
    btns.forEach((btn) => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();

        const el = e.target;

        if (el.classList.contains('is-disabled')) return;

        const data = {
          action: 'woocommerce_ajax_add_to_cart',
          product_id: e.target.dataset.product_id,
          product_sku: e.target.dataset.product_sku,
          quantity: 1,
          variation_id: e.target.dataset.variation,
        };

        const self = this;

        jQuery.ajax({
          type: 'POST',
          url: wc_add_to_cart_params.ajax_url,
          data: data,
          beforeSend() {
            el.classList.add('is-disabled');
          },
          complete() {
            el.classList.remove('is-disabled');
          },
          success: (resp) => {
            if (resp.success !== false) {
              el.parentElement.classList.add('to-cart-box--added');
              el.innerText = 'Skoða körfu';

              el.classList.remove('ajax_add_to_cart');
              const newBtn = el.cloneNode(true);
              el.parentElement.replaceChild(newBtn, el);

              const cartLink = document.querySelector('.header__cart-link');

              cartLink.classList.add('heartBeat');
              setTimeout(() => cartLink.classList.remove('heartBeat'), 1300);

              if (cartLink.children[1]) {
                const value = parseInt(cartLink.children[1].innerText);
                cartLink.children[1].innerText = value + 1;
              } else {
                const span = document.createElement('span');

                span.className = 'quantity-product-circle';
                span.innerText = '1';

                cartLink.appendChild(span);
              }

              self.alert('Product added', false);
            }
          },
        });
      });
    });
  }
};

Main.prototype.fixInputsInCheckout = function() {
  if (!this.isCheckout) return;

  jQuery('.woocommerce-input-wrapper').each(function() {
    jQuery(this).insertBefore(jQuery(this).prev())
  });

  jQuery('.login__new-client--checkout .form__input').unwrap();
  jQuery('.form__input-box--textarea textarea').unwrap();
  jQuery('#account_password').unwrap();
};

Main.prototype.initCatalogProductSliders = function() {
  if (!this.catalogProductWrappers) return;

  const initSlick = () => {
    if (typeof jQuery !== 'function') return;

    jQuery('.category-product__product-list').slick({
      arrows: false,
      dots: false,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
        {
          breakpoint: 99999,
          settings: 'unslick',
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          },
        },
        {
          breakpoint: 575,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          }
        }
      ],
    });
  };

  if (window.matchMedia('(max-width: 992px)').matches) {
    initSlick();
  }

  window.addEventListener('resize', () => {
    if (window.matchMedia('(max-width: 992px)').matches) {
      jQuery('.category-product__product-list').slick('refresh')
    }
  });
};

Main.prototype.init = function() {
  this.initHamburgerMenu();
  this.setAnimations();
  this.smoothAnchors();
  this.fixCatalogsTitle();
  this.initVideoViewer();
  this.initFooterForm();
  this.setClientsSlider();
  this.setTestimonialsSlider();
  this.setFormFloatedLabels();

  this.setCartInputButtons();
  this.fixCheckoutNotice();

  this.initShopSlider();
  this.initShopSidebar();
  this.initAddToCartAJAX();

  this.setSingleInputButtons();
  this.setCloseModalButton();
  this.setSingleProductGallery();

  this.fixInputsInCheckout();
  this.initCatalogProductSliders();
};

document.addEventListener('DOMContentLoaded', () => {
  const m = new Main;
  m.init();

  const a = new Account;
  a.init();

  const c = new Comparing;
  c.init();
});