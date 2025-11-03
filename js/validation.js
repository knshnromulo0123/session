document.addEventListener('DOMContentLoaded', function() {
  // Initialize validation on all forms
  initializeValidation();
  
  // Toggle password visibility functionality
  setupPasswordToggles();
});

/**
 * Initialize validation on all forms
 */
function initializeValidation() {
  // Get all forms on the page
  const forms = document.querySelectorAll('form');
  
  forms.forEach(form => {
    form.addEventListener('submit', function(event) {
      if (!validateForm(form)) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    });
    
    // Add input event listeners for real-time validation
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
      input.addEventListener('input', function() {
        validateInput(input);
      });
      
      input.addEventListener('blur', function() {
        validateInput(input);
      });
    });
  });
}

/**
 * Validate an entire form
 * @param {HTMLFormElement} form - The form to validate
 * @returns {boolean} - Whether the form is valid
 */
function validateForm(form) {
  let isValid = true;
  const inputs = form.querySelectorAll('input, select, textarea');
  
  inputs.forEach(input => {
    if (!validateInput(input)) {
      isValid = false;
    }
  });
  
  return isValid;
}

/**
 * Validate a single input field
 * @param {HTMLElement} input - The input to validate
 * @returns {boolean} - Whether the input is valid
 */
function validateInput(input) {
  let isValid = true;
  let errorMessage = '';
  
  // Clear previous error messages
  clearErrorFor(input);
  
  // Skip validation for non-required fields that are empty
  if (!input.hasAttribute('required') && !input.value.trim()) {
    return true;
  }
  
  // Validate based on input type
  switch(input.type) {
    case 'email':
      isValid = validateEmail(input.value);
      errorMessage = 'Please enter a valid email address';
      break;
    case 'password':
      isValid = validatePassword(input.value);
      errorMessage = 'Password must be at least 6 characters';
      break;
    case 'tel':
      isValid = validatePhone(input.value);
      errorMessage = 'Please enter a valid phone number';
      break;
    default:
      if (input.hasAttribute('required') && !input.value.trim()) {
        isValid = false;
        errorMessage = 'This field is required';
      }
  }
  
  // Handle custom validations based on id or name
  if (input.id === 'confirmPassword' || input.name === 'confirmPassword') {
    const password = document.querySelector('#password') || document.querySelector('[name="password"]');
    if (password && input.value !== password.value) {
      isValid = false;
      errorMessage = 'Passwords do not match';
    }
  }
  
  // Show error if invalid
  if (!isValid) {
    showErrorFor(input, errorMessage);
  }
  
  return isValid;
}

/**
 * Email validation
 * @param {string} email - The email to validate
 * @returns {boolean} - Whether the email is valid
 */
function validateEmail(email) {
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

/**
 * Password validation
 * @param {string} password - The password to validate
 * @returns {boolean} - Whether the password is valid
 */
function validatePassword(password) {
  return password.length >= 6;
}

/**
 * Phone validation
 * @param {string} phone - The phone number to validate
 * @returns {boolean} - Whether the phone number is valid
 */
function validatePhone(phone) {
  const re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
  return re.test(String(phone));
}

/**
 * Show error message for an input
 * @param {HTMLElement} input - The input with an error
 * @param {string} message - The error message
 */
function showErrorFor(input, message) {
  const formGroup = input.closest('.mb-3') || input.parentElement;
  const errorElement = document.createElement('div');
  errorElement.className = 'invalid-feedback';
  errorElement.innerText = message;
  
  input.classList.add('is-invalid');
  
  // Only add the message if it doesn't exist yet
  if (!formGroup.querySelector('.invalid-feedback')) {
    formGroup.appendChild(errorElement);
  }
}

/**
 * Clear error message for an input
 * @param {HTMLElement} input - The input to clear errors for
 */
function clearErrorFor(input) {
  const formGroup = input.closest('.mb-3') || input.parentElement;
  const errorElement = formGroup.querySelector('.invalid-feedback');
  
  input.classList.remove('is-invalid');
  input.classList.remove('is-valid');
  
  if (errorElement) {
    errorElement.remove();
  }
}

/**
 * Setup password toggle visibility
 */
function setupPasswordToggles() {
  const toggleButtons = document.querySelectorAll('[id^="toggle"]');
  
  toggleButtons.forEach(button => {
    button.addEventListener('click', function() {
      const targetId = this.id.replace('toggle', '');
      const passwordInput = document.getElementById(targetId);
      const icon = this.querySelector('i');
      
      if (passwordInput) {
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
        } else {
          passwordInput.type = 'password';
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
        }
      }
    });
  });
}