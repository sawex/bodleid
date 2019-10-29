/**
 * @abstract
 * @constructor
 */
const Abstract = function() {
  if (this.constructor === Abstract) {
    throw new Error('Can\'t instantiate abstract class!');
  }

  // Page tests
  this.isCart = !!document.querySelector('.woocommerce-cart');
  this.isShop = !!document.querySelector('.woocommerce-shop');
  this.isSingle = !!document.querySelector('.single-product');
  this.isCheckout = !!document.querySelector('.woocommerce-checkout');
  this.isComparison = !!document.querySelector('.page-comparison');
  this.isLostPassword = !!document.querySelector('.page-template-tmp-lost-password');
};

/**
 * Shows WooCommerce-like notice in account and some shop pages
 *
 * @param {string} message Notice text
 */
Abstract.prototype.alert = function(message = '') {
  const wrapper = document.querySelector('.woocommerce-message--login-page');
  const paragraph = document.querySelector('.woocommerce-message--login-page .woocommerce-message__text');

  if (wrapper) {
    wrapper.classList.remove('woocommerce-message--hidden');
    paragraph.innerHTML = message;

    setTimeout(() => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    }, 300);

  }
};

/**
 * Adds error class to invalid fields.
 *
 * @param {NodeList} formElements Form fields
 * @param {array} invalidFields Invalid fields
 * @param {object} errorMessages
 */
Abstract.prototype.highlightInvalidFields = function(formElements, invalidFields, errorMessages = {}) {
  formElements.forEach((input) => input.classList.remove('form__input--error'));
  let message = '<ul>';

  invalidFields.forEach((field) => {
    const input = document.querySelector(`[name=${field}]`);
    input.classList.add('form__input--error');

    if (errorMessages[field]) {
      message += `<li>${errorMessages[field]}</li>`;
    }
  });

  message += '</ul>';

  if (message.length > 9 && typeof this.alert === 'function') {
    this.alert(message);
  }
};

export default Abstract;