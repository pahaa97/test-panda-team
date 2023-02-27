const formLogin = document.getElementById('login-form');
if (formLogin) {
    formLogin.addEventListener('submit', (event) => {
        event.preventDefault();
        const formData = new FormData(formLogin);
        clearForm();
        fetch('/login', {
            method: 'POST',
            body: formData
        })
            .then((response) => {
                if (response.ok) {
                    window.location.href = '/dashboard';
                    return;
                }
                return response.json();
            })
            .then((data) => {
                for (const [fieldName, errorMessages] of Object.entries(data.errors)) {
                    const field = formLogin.querySelector(`[name=${fieldName}]`);
                    const errorContainer = formLogin.querySelector(`#${fieldName}-error`);
                    errorContainer.textContent = errorMessages.join('. ');
                    field.classList.add('is-invalid');
                }
            });
    });
}

const formRegister = document.getElementById('register-form');
if (formRegister) {
    formRegister.addEventListener('submit', (event) => {
        event.preventDefault();
        const formData = new FormData(formRegister);
        clearForm();
        fetch('/registration', {
            method: 'POST',
            body: formData
        })
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                if (data.success) {
                    const successContainer = document.querySelector(`#success`);
                    console.log(successContainer);
                    successContainer.classList.add('alert-success');
                    successContainer.innerHTML = data.success;
                    setTimeout(function () {
                        window.location.href = '/login';
                    }, 3000)
                    return;
                }
                for (const [fieldName, errorMessages] of Object.entries(data.errors)) {
                    const field = formRegister.querySelector(`[name=${fieldName}]`);
                    const errorContainer = formRegister.querySelector(`#${fieldName}-error`);
                    errorContainer.textContent = errorMessages.join('. ');
                    field.classList.add('is-invalid');
                }
            });
    });
}

function clearForm() {
    const formControl = document.querySelectorAll('.form-control')
    if (formControl) {
        formControl.forEach(function (element) {
            element.classList.remove('is-invalid');
        })}
    const invalidFideback = document.querySelectorAll('.invalid-feedback')
    if (invalidFideback) {
        invalidFideback.forEach(function (element) {
                element.innerHTML = '';
            })}
    const pass = document.querySelector('#password');
    if (pass) { pass.value = ''; }
    const pass_conf = document.querySelector('#password_confirmation')
    if (pass_conf) { pass_conf.value = ''; }
}
