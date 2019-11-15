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
  this.isLostPassword = !!document.querySelector('.page-forgot-password');
};

/**
 * Shows WooCommerce-like notice in account and some shop pages
 *
 * @param {string} message Notice text
 * @param {boolean} scrollToTop
 */
Abstract.prototype.alert = function(message = '', scrollToTop = true) {
  const wrapper = document.querySelector('.woocommerce-notices-wrapper');
  const existsNotice = document.querySelector('.woocommerce-message');

  if (wrapper) {
    if (!existsNotice) {
      const notice = document.createElement('div');

      notice.className = 'woocommerce-message';
      notice.setAttribute('role', 'alert');

      notice.innerHTML = `
        <button class="w-close-btn" aria-label="Close alert"></button>
        ${message}
    `;

      wrapper.appendChild(notice);

      setTimeout(() => {
        notice.style.animation = 'toBottom 1s forwards';
        setTimeout(() => notice.remove(), 1000);
      }, 3500);
    } else {
      existsNotice.innerHTML = `
        <button class="w-close-btn" aria-label="Close alert"></button>
        ${message}
      `;

      setTimeout(() => {
        existsNotice.style.animation = 'toBottom 1s forwards';
        setTimeout(() => existsNotice.remove(), 1000);
      }, 3500);
    }

    if (scrollToTop) {
      setTimeout(() => {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      }, 300);
    }
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