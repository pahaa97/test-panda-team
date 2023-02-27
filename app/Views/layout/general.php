<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/dashboard">Фиктивные опросы</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">Главная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/polls">Список опросов</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/polls/create">Создать опрос</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <form action="/logout" method="post">
                    <button type="submit" class="btn btn-link nav-link">Выход</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<?php include(__DIR__.'/../'.$content); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="/resources/js/general.js"></script>
</body>
</html>
