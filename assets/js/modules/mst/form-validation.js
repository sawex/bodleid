/**
 * FORM VALIDATION FUNCTION
 *
 * Validates fields using options object and converts FormData iteration object
 * to usual JS Object in format:
 * { fieldName: fieldValue }
 *
 * @version 1.0.1
 *
 * @param {object} form Instance of FormData object.
 * @param {object} validateOptions Validation parameters.
 *
 * @return {object} Returns if form is true by validateOptions, returns false, if not.
 */
const validateForm = function(form, validateOptions = {}) {
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

export default validateForm;