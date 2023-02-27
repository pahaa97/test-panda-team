<div class="container mt-4">
    <h1>Главная</h1>
    <p>Привет, <?php echo (!empty($user_email)) ? $user_email : '' ?></p>

    <h2>API ключ</h2>
    <p>Ваш API ключ: <kbd><?php echo (!empty($api_key)) ? $api_key : "null" ?></kbd></p>
    <p>Этот ключ необходим для доступа к API нашего сервиса. Никому не сообщайте его.</p>
    <p>Документация доступна по <a href="/documentation" target="_blank">ссылке.</a></p>
</div>
