<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <p id="success" class='alert'></p>
            <div class="card">
                <div class="card-header">Регистрация</div>
                <div class="card-body">
                    <form id="register-form" action="/registration" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div id="email-error" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div id="password-error" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            <div id="password_confirmation-error" class="invalid-feedback"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                        <span>Есть аккаунт? <a href="/login">Авторизация</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
