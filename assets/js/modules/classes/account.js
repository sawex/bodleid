/* global mainState, jQuery */
/**
 * ACCOUNT
 * Methods for work with account page, login and sign up forms
 *
 * @constructor
 */
import Abstract from './abstract.js';
import validateForm from '../mst/form-validation.js';

const Account = function() {
  Abstract.apply(this, arguments);

  // Forms
  this.loginForm = document.querySelector('.login__form--login');
  this.signupForm = document.querySelector('.login__new-client--signup');
  this.accountForm = document.querySelector('.login__new-client--account');
  this.accountForms = document.querySelectorAll('.login__form');

  // Validation rules for "Sign up" and "Update account data" forms
  this.userFieldsRules = {
    fields: {
      billing_first_name: (value) => {
        return (
          /^[ÁáÐðÉéÍíÓóÚúÝýÞþÆæÖöA-Za-z\s]+$/.test(value.trim()) &&
          value.trim().length &&
          value.trim().length <= 20
        );
      },
      billing_email: (value) => /\S+@\S+\.\S+/.test(value),
      billing_phone: (value) => {
        return (
          /^[0-9]+$/.test(value.trim()) &&
          value.trim().length &&
          value.trim().length <= 12
        );
      },
      password: (value) => value.trim().length > 6,
      billing_address_1: (value) => value.trim().length,
      billing_city: (value) => value.trim().length,
      billing_postcode: (value) => value.trim().length,
    }
  };

  // Validation errors for "Sign up" and "Update account data" forms
  this.userErrorMessages = {
    billing_first_name: 'First name field cannot be empty',
    billing_email: 'Enter valid email address',
    billing_phone: 'Phone number can contains digits only and cannot be longer than 12 digits',
    password: 'Password cannot be shorter than 6 symbols',
    billing_address_1: 'Address field name cannot be empty',
    billing_city: 'City field name cannot be empty',
    billing_postcode: 'Postcode field cannot be empty',
  };

  // Account
  this.accountMenu = document.querySelector('.account__nav-list');
};

Account.prototype = Object.create(Abstract.prototype);
Account.prototype.constructor = Account;

/**
 * LOGIN FORM
 * Initialize form on login and checkout pages.
 * */
Account.prototype.initLoginForm = function() {
  if (!this.loginForm) return;

  this.loginForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const isValid = validateForm(e.target, {
      fields: {
        email: (value) => /\S+@\S+\.\S+/.test(value),
        user_password: (value) => value.trim().length,
      }
    });

    const errorMessages = {
      email: 'Enter valid email address',
      user_password: 'Enter your password',
    };

    if (isValid.result) {
      const self = this;

      jQuery.ajax({
        type: 'POST',
        url: mainState.ajaxUrl,
        data: {
          action: 'mst_bodleid_login',
          data: isValid.data,
        },
        success(resp) {
          console.log(resp);
          if (resp.success) {
            if (e.target.dataset.redirect) {
              location = e.target.dataset.redirect;
            } else {
              location = mainState.accountUrl;
            }
          } else {
            self.alert(resp.data.error);
          }
        },
      });
    } else {
      this.highlightInvalidFields(
        e.target.querySelectorAll('.login__form--login .form__input'),
        isValid.invalidFields,
        errorMessages
      );
    }
  });
};

/**
 * SIGN UP FORM
 * */
Account.prototype.initSignupForm = function() {
  if (!this.signupForm) return;

  this.signupForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const isValid = validateForm(e.target, this.userFieldsRules);

    if (isValid.result) {
      jQuery.ajax({
        type: 'POST',
        url: mainState.ajaxUrl,
        data: {
          action: 'mst_bodleid_sign_up',
          data: isValid.data,
        },
        success(resp) {
          console.log(resp);
          if (resp.success) {
            location = mainState.accountUrl;
          } else {
            this.alert(resp.data.error);
          }
        },
      });
    } else {
      this.highlightInvalidFields(
        e.target.querySelectorAll('.login__new-client--signup .form__input'),
        isValid.invalidFields,
        this.userErrorMessages
      );
    }
  });
};

/**
 * UPDATE ACCOUNT DATA FORM
 * */
Account.prototype.initAccountForm = function() {
  if (!this.accountForm) return;

  this.accountForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const isValid = validateForm(e.target, this.userFieldsRules);

    if (isValid.result) {
      jQuery.ajax({
        type: 'POST',
        url: mainState.ajaxUrl,
        data: {
          action: 'mst_bodleid_update_account_data',
          data: isValid.data,
        },
        success(resp) {
          console.log(resp);
          if (resp.success) {
            location = mainState.accountUrl;
          } else {
            this.alert(resp.data.error);
          }
        },
      });
    } else {
      this.highlightInvalidFields(
        e.target.querySelectorAll('.login__new-client--signup .form__input'),
        isValid.invalidFields,
        this.userErrorMessages
      );
    }
  });
};

/**
 * Sets up the account page sidebar menu.
 * */
Account.prototype.initAccountMenu = function() {
  if (!this.accountMenu) return;

  this.accountMenu.addEventListener('click', (e) => {
    const el = e.target;

    if (el.classList.contains('account__nav-link')) {
      const links = this.accountMenu.querySelectorAll('a');

      links.forEach((link) => link.classList.remove('account__nav-link--active'));
      el.classList.add('account__nav-link--active');

      if (el.dataset.href === 'orders') {
        document.querySelector('.orders').classList.remove('hidden');
        document.querySelector('.account-data-container').classList.add('hidden');
      }

      if (el.dataset.href === 'account') {
        document.querySelector('.orders').classList.add('hidden');
        document.querySelector('.account-data-container').classList.remove('hidden');
      }
    }
  });
};

/**
 * Sets up form collapsing on form title clicking.
 * */
Account.prototype.setFormsCollapsing = function() {
  if (!this.accountForms.length) return;

  this.accountForms.forEach((form) => {
    const title = form.querySelector('.login__title');

    title.addEventListener('click', () => {
      form.classList.toggle('collapsed');
      title.classList.toggle('login__title--active');
    });
  });
};

Account.prototype.init = function() {
  this.initLoginForm();
  this.initSignupForm();
  this.initAccountForm();
  this.initAccountMenu();
  this.setFormsCollapsing();
};

export default Account;