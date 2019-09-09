/* global jQuery, AOS */

const Main = function() {
  this.hambButton = document.querySelector('.hamburger');
  this.mobileMenu = document.querySelector('.header__mobile-menu');
  this.mobileMenuWrapper = document.querySelector('.mobile-menu-wrapper');

  this.footerForm = document.querySelector('form.form');
};

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

Main.prototype.smoothAnchors = function() {
  document.querySelectorAll('a[href*="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();

      const pageUrl = new URL(document.URL);
      const url = new URL(anchor.href);
      const hash = url.hash;

      if (url.pathname === pageUrl.pathname) {
        const target = document.querySelector(hash);

        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
          });
        }
      } else {
        location = url.href;
      }
    });
  });
};

Main.prototype.setClientsSlider = function() {
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
        }
      }
    ],
  });
};

Main.prototype.setTestimonialsSlider = function() {
  jQuery('.testimonials__reviews').slick({
    prevArrow: '',
    nextArrow: '',
    dots: true,
    appendDots: jQuery('.testimonials__buttons'),
    customPaging: function(slider, i) {
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
};

/**
 * Form validation function
 *
 * @param {object} form Instance of FormData object.
 * @param {object} validateOptions Validation parameters.
 *
 * @return {boolean} Returns if form is true by validateOptions, returns false, if not.
 */
Main.prototype.validateForm = function(form, validateOptions = {}) {
  const formData = new FormData(form);
  const dataObj = {};
  let isValid = true;

  // Transform all form field to object and validate them if validation function is available
  for (const field of formData.entries()) {
    const key = field[0];
    const value = field[1];

    // If there is validation function for the field then execute it and save the result if negative
    if (validateOptions.fields[key]) {
      validateOptions.fields[key](value) === false ? isValid = false : null;
    }

    dataObj[key] = value;
  }

  // Make form invalid if some of fields missed
  if (validateOptions.count && validateOptions.count !== Object.keys(dataObj).length) {
    isValid = false;
  }

  return isValid;
};

Main.prototype.initFooterForm = function(data) {
  this.footerForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const isValid = this.validateForm(e.target, {
      fieldsCount: 2,
      fields: {
        phone: (value) => value.trim().length > 5 && !isNaN(value.replace(/\s/g, '')),
        name: (value) => value.trim().length >= 2
      }
    });

    if (isValid) {
      const self = this;

      jQuery.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        data: {
          action: 'mst_bodleid_cb',
          data,
        },
        success(resp) {
          alert(JSON.stringify(resp));
          self.footerForm.reset();
        },
      });
    }
  });
};

Main.prototype.init = function() {
  this.initHamburgerMenu();
  this.setAnimations();
  this.smoothAnchors();
  this.initFooterForm();
  this.setClientsSlider();
  this.setTestimonialsSlider();
};

document.addEventListener('DOMContentLoaded', () => {
  const m = new Main;
  m.init();
});


//Animated inputs
  const inputAnimate = document.querySelectorAll('.form__input');
    inputAnimate.forEach((el) => {
     el.addEventListener('change', () => {
       if (el.value == '') {
         el.classList.remove('form__input-filled');
       } else {
         el.classList.add('form__input-filled')
       }
     })
   });