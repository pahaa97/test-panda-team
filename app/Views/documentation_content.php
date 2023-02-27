<!DOCTYPE html>
<html>
<head>
    <title>Документация API</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Документация API</h1>
    <p>Запросы должны отправляться на адрес сервиса <code><?php echo $_SERVER['SERVER_NAME']?></code> с добавлением нужного метода.</p>
    <h2 class="mt-4">Получение данных случайного опубликованного опроса из списка опросов пользователя</h2>
    <kbd>URL: /api/<code>{api_key}</code>/random-poll</kbd>
    <p>HTTP метод: GET</p>
    <h3 class="mt-4">Параметры запроса:</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Параметр</th>
            <th>Тип</th>
            <th>Обязательный</th>
            <th>Описание</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>api_key</td>
            <td>string</td>
            <td>да</td>
            <td>API ключ пользователя</td>
        </tr>
        </tbody>
    </table>
    <h3 class="mt-4">Пример запроса:</h3>
    <kbd><b>GET</b> /api/<code>1234567890abcdef</code>/random-poll</kbd>
    <h3 class="mt-4">Успешный ответ:</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Параметр</th>
            <th>Тип</th>
            <th>Описание</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>title</td>
            <td>string</td>
            <td>Заголовок опроса</td>
        </tr>
        <tr>
            <td>options</td>
            <td>array</td>
            <td>
                Массив вариантов ответов, содержащий следующую информацию для каждого варианта ответа:<br>
                title - заголовок варианта ответа;<br>
                votes - количество голосов, отданных за данный вариант ответа.
            </td>
        </tr>
        </tbody>
    </table>
    <div class="mb-5">
        <h3 class="mt-4">Пример ответа:</h3>
        <pre><code>
            {
                "title": "Заголовок опроса",
                "options": [
                    {
                        "title": "Вариант ответа 1",
                        "votes": 10
                    },
                    {
                        "title": "Вариант ответа 2",
                        "votes": 5
                    },
                    {
                        "title": "Вариант ответа 3",
                        "votes": 3
                    }
                ]
            }
        </code></pre>
    </div>
</div>


<style>
    pre {
        padding: 0.2rem 0.4rem;
        font-size: 87.5%;
        color: #fff;
        background-color: #212529;
        border-radius: 0.2rem;
        border: 1px solid #ccc;
        font-family: Consolas, monaco, monospace;
        margin: 0 2px;
    }
</style>


