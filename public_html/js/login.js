let submitbtn = document.getElementById('submitButton');
let usernameInput = document.getElementById('username');
let passwordInput = document.getElementById('password');

function enableDisableSubmit() {
    const regex = new RegExp('^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4}$');

    let username = usernameInput.value;
    let password = passwordInput.value;

    if (regex.test(username) && password!=='') {
        if (submitbtn.hasAttribute('disabled')) {
            submitbtn.removeAttribute('disabled');
        }
    } else {
        if(!submitbtn.hasAttribute('disabled')) {
            submitbtn.setAttribute('disabled', '');
        }
    }

}

usernameInput.addEventListener('input', enableDisableSubmit, false);
passwordInput.addEventListener('input', enableDisableSubmit, false);