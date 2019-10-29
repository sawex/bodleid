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
  this.lostPassFirst = document.querySelector('.login__form--restore-password');
  this.lostPassSecond = document.querySelector('.login__form--new-password');
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
      billing_address_1: (value) => value.trim().length,
      billing_city: (value) => value.trim().length,
      billing_postcode: (value) => value.trim().length,
    }
  };

  // Validation errors for "Sign up" and "Update account data" forms
  this.userErrorMessages = {
    billing_first_name: mainState.i18n.error_billing_first_name,
    billing_email: mainState.i18n.error_billing_email,
    billing_phone: mainState.i18n.error_billing_phone,
    password: mainState.i18n.error_password,
    billing_address_1: mainState.i18n.error_billing_address_1,
    billing_city: mainState.i18n.error_billing_city,
    billing_postcode: mainState.i18n.error_billing_postcode,
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

    const isValid = validateForm(e.target, {
      password: (value) => value.trim().length > 6,
      ...this.userFieldsRules,
    });

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
    const self = this;

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
            self.highlightInvalidFields(
              e.target.querySelectorAll('.login__new-client--signup .form__input'),
              [],
              self.userErrorMessages
            );

            self.alert(mainState.i18n.dataUpdated);
          } else {
            self.alert(resp.data.error);
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
 * FIRST LOST PASSWORD FORM
 * */
Account.prototype.initFirstLostPasswordForm = function() {
  if (!this.isLostPassword || !this.lostPassFirst) return;

  this.lostPassFirst.addEventListener('submit', (e) => {
    e.preventDefault();

    const isValid = validateForm(e.target, {
      fields: {
        'restore-email': (value) => /\S+@\S+\.\S+/.test(value),
      },
    });

    const errorMessages = {
      'restore-email': 'Enter valid email address',
    };

    const self = this;

    if (isValid.result) {
      jQuery.ajax({
        type: 'POST',
        url: mainState.ajaxUrl,
        data: {
          action: 'mst_bodleid_restore_password_first',
          data: isValid.data,
        },
        success(resp) {
          console.log(resp);
          if (resp.success) {
            self.lostPassFirst.remove();
            document.querySelector('.search__result-title-box').classList.remove('hidden');
          } else {
            self.alert(resp.data.error);
          }
        },
      });
    } else {
      this.highlightInvalidFields(
        e.target.querySelectorAll('.login__form--restore-password .form__input'),
        isValid.invalidFields,
        errorMessages
      );
    }
  });
};

/**
 * SECOND LOST PASSWORD FORM
 * */
Account.prototype.initSecondLostPasswordForm = function() {
  if (!this.isLostPassword || !this.lostPassSecond) return;

  this.lostPassSecond.addEventListener('submit', (e) => {
    e.preventDefault();

    const isValid = validateForm(e.target, {
      fields: {
        'new_password_first': (value) => value.length >= 6,
        'new_password_second': (value) => value.length >= 6,
      },
    });

    const errorMessages = {
      'new_password_first': mainState.i18n.error_password,
    };

    if (isValid.result) {
      if (isValid.data.new_password_first !== isValid.data.new_password_second) {
        return this.highlightInvalidFields(
          e.target.querySelectorAll('.login__form--restore-password .form__input'),
          ['new_password_first', 'new_password_second'],
          {'new_password_first': mainState.i18n.error_passwords_arent_equal}
        );
      }

      const body = {
        key: restoreData.key,
        login: restoreData.login,
        ...isValid.data
      };

      const self = this;

      jQuery.ajax({
        type: 'POST',
        url: mainState.ajaxUrl,
        data: {
          action: 'mst_bodleid_restore_password_second',
          data: body,
        },
        success(resp) {
          console.log(resp);
          if (resp.success) {
            location = mainState.loginUrl;
          } else {
            self.alert(resp.data.error);
          }
        },
      });
    } else {
      this.highlightInvalidFields(
        e.target.querySelectorAll('.login__form--restore-password .form__input'),
        isValid.invalidFields,
        errorMessages
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
  this.initFirstLostPasswordForm();
  this.initSecondLostPasswordForm();
  this.setFormsCollapsing();
};

export default Account;