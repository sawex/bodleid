/* global jQuery, AOS */

const Main = function() {
  this.hambButton = document.querySelector('.hamburger');
  this.mobileMenu = document.querySelector('.header__mobile-menu');
  this.mobileMenuWrapper = document.querySelector('.mobile-menu-wrapper');

  this.footerForm = document.querySelector('form.form');
  this.footerFormInputs = document.querySelectorAll('.form__input');
  this.footerFormErrorMessage = document.querySelector('.form__error');
  this.footerFormSuccessMessage = document.querySelector('.form__success');

  this.instructionVideoLinks = document.querySelectorAll('.main-instructions__video');
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

/**
 * Smooth scroll to an anchor target
 *
 * @version 1.0.1
 */
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
 * @version 1.0.1
 *
 * @param {object} form Instance of FormData object.
 * @param {object} validateOptions Validation parameters.
 *
 * @return {object} Returns if form is true by validateOptions, returns false, if not.
 */
Main.prototype.validateForm = function(form, validateOptions = {}) {
  const formData = new FormData(form);
  const dataObj = {};
  const invalidFields = [];

  // Transform all form field to object and validate them if validation function is available
  for (const field of formData.entries()) {
    const key = field[0];
    const value = field[1];

    // If there is validation function for the field then execute it and save the result if negative
    if (validateOptions.fields[key]) {
      if (!validateOptions.fields[key](value)) {
        invalidFields.push(key);
      }
    }

    dataObj[key] = value;
  }

  // Make form invalid if some of fields missed
  if (validateOptions.count && validateOptions.count !== Object.keys(dataObj).length) {
    validateOptions.push('_invalidCount');
  }

  if (invalidFields.length) {
    return {
      result: false,
      invalidFields,
    };
  } else {
    return {
      result: true,
      data: dataObj,
    };
  }
};

Main.prototype.initFooterForm = function() {
  this.footerForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const isValid = this.validateForm(e.target, {
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
        url: '/wp-admin/admin-ajax.php',
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
      const fields = isValid.invalidFields;

      this.footerFormInputs.forEach((input) => input.classList.remove('form__input--error'));

      fields.forEach((field) => {
        const input = this.footerForm.querySelector(`[name=${field}]`);
        input.classList.add('form__input--error');
      });

      this.footerFormErrorMessage.classList.add('form__error--is-active');
    }
  });
};

Main.prototype.setFooterFormFloatedLabels = function() {
  const checkLabel = (input) => {
    if (!input.value) {
      input.classList.remove('form__input-filled');
    } else {
      input.classList.add('form__input-filled');
    }
  };

  this.footerFormInputs.forEach((input) => {
    // Check if values are on page loading (e.g. if user wrote something in input and reloaded page)
    checkLabel(input);

    input.addEventListener('change', () => {
      checkLabel(input);
    });
  });
};

Main.prototype.init = function() {
  this.initHamburgerMenu();
  this.setAnimations();
  this.smoothAnchors();
  this.initVideoViewer();
  this.initFooterForm();
  this.setClientsSlider();
  this.setTestimonialsSlider();
  this.setFooterFormFloatedLabels();
};

document.addEventListener('DOMContentLoaded', () => {
  const m = new Main;
  m.init();
});
