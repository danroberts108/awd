const emailInput = document.getElementById('registration_form_email');
const fnameInput = document.getElementById('registration_form_fname');
const lnameInput = document.getElementById('registration_form_lname');
const passwordInput = document.getElementById('registration_form_plainPassword');
const agreeInput = document.getElementById('registration_form_agreeTerms');
const submitBtn = document.getElementById('submitButton');

function checkForm() {
    const regex = new RegExp('^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4}$');

    let username = emailInput.value;
    let password = passwordInput.value;
    let fname = fnameInput.value;
    let lname = lnameInput.value;
    let agree = agreeInput.value;

    if (regex.test(username) && password!=='' && fname!=='' && lname!=='' && agree === true) {
        if (submitBtn.hasAttribute('disabled')) {
            submitBtn.removeAttribute('disabled');
        }
    } else {
        if(!submitBtn.hasAttribute('disabled')) {
            submitBtn.setAttribute('disabled', '');
        }
    }
}