/**
 * Project: bootstrap-contact-form
 * User: Gert Massheimer
 * Date: 25.Nov.2019
 * Time: 13:09
 * File: contact.js
 * ------------------------------------------------- */

/**
 * Validate the input fields / reset the form / switch the mode.
 * Based on starter script provided by bootstrap
 */
(function() {
  'use strict';
  window.addEventListener('load', () => {
    // ---- Dark-Light-Mode Switch -------------------------------------------------------------------------------------
    /**
     * Get value of CSS-Element.
     * @param propKey
     * @returns {string}
     */
    const getCSSCustomProp = (propKey) => {
      let response = getComputedStyle(document.documentElement).getPropertyValue(propKey);
      if (response.length)
        response = response.replace(/['"]/g, '').trim();
      return response;
    };
    const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
    if (getCSSCustomProp('--color-mode') === 'dark')
      toggleSwitch.checked = true;
    /**
     * Switch dark-light-mode
     * @param e
     */
    function switchTheme(e) {
      e.preventDefault();
      if (e.target.checked)
        document.documentElement.setAttribute('data-user-color-scheme', 'dark');
      else
        document.documentElement.setAttribute('data-user-color-scheme', 'light');
    }
    toggleSwitch.addEventListener('change', switchTheme, false);
    // --- Let the reset button reload the page ------------------------------------------------------------------------
    const reset = document.getElementById('reset');
    reset.onclick = () => {window.location.reload()};
    // --- Fetch all the forms we want to apply custom Bootstrap validation styles to ----------------------------------
    const forms = document.getElementsByClassName('needs-validation');
    Array.prototype.filter.call(forms, function(form) { // Loop over them and prevent submission
      form.addEventListener('submit', (e) => {
        if (form.checkValidity() === false) {
          e.preventDefault();
          e.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

// noinspection JSUnusedGlobalSymbols
/**
 * Check the captcha answer while it's changed.
 * @param msgEquation1
 * @param result
 * @param msgEquation2
 */
function captcha(msgEquation1, result, msgEquation2) { // the captcha is making use of PHP variables
  const human = document.getElementById('human');
  const answer = Number(document.getElementById('human').value);
  const humanFeedback = document.getElementById('human-feedback');
  if (answer !== Number(result)) { // ---- result is incorrect
    human.classList.add('is-invalid');
    if (human.classList.contains('is-valid'))
      human.classList.remove('is-valid');
    humanFeedback.innerHTML = msgEquation1 + answer + msgEquation2;
    humanFeedback.classList.add('invalid-human-feedback');
    if (humanFeedback.classList.contains('valid-human-feedback'))
      humanFeedback.classList.remove('valid-human-feedback');
  }
  else { // ---- result is correct
    human.classList.add('is-valid');
    if (human.classList.contains('is-invalid'))
      human.classList.remove('is-invalid');
    humanFeedback.innerHTML = '&nbsp;';
  }
}


