/**
 * Adds error class to invalid fields.
 *
 * @param {NodeList} formElements Form fields
 * @param {array} invalidFields Invalid fields
 * @param {object} errorMessages
 */
const highlightInvalidFields = function(formElements, invalidFields, errorMessages = {}) {
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

  if (this.footerFormErrorMessage) {
    this.footerFormErrorMessage.classList.add('form__error--is-active');
  }
};

export default highlightInvalidFields;