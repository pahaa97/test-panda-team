<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <p id="success" class='alert'></p>
            <div class="card">
                <div class="card-header">Логин</div>
                <div class="card-body">
                    <form id="login-form" action="/login" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" required>
                            <div id="email-error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                            <div id="password-error" class="invalid-feedback"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Авторизация</button>
                        <span>Нет аккаунта? <a href="/registration">Регистрация</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
