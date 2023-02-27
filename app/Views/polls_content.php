<div class="container mt-4">
    <h1>Список опросов</h1>
    <div class="btn-group mb-3" role="group">
        <button type="button" class="btn btn-secondary sort-btn" data-field="title">Сортировать по названию</button>
        <button type="button" class="btn btn-secondary sort-btn" data-field="status">Сортировать по статусу</button>
        <button type="button" class="btn btn-secondary sort-btn" data-field="created_at">Сортировать по дате создания</button>
    </div>
    <table id="polls" class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Опрос</th>
            <th scope="col">Статус</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    const tbody = document.querySelector('#polls tbody');
    const sortButtons = document.querySelectorAll('.sort-btn');
    let direction = 'asc'; // начальное направление сортировки

    const updateTable = (polls) => {
        tbody.innerHTML = '';
        polls.forEach(poll => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <th scope="row">${poll.id}</th>
                <td>${poll.title}</td>
                <td>${poll.status}</td>
                <td>${poll.created_at}</td>
                <td>
                    <a href="/polls/${poll.id}" class="btn btn-primary">Редактировать</a>
                    <form id="delete-poll-form" class="btn" action="/polls/${poll.id}/delete" method="POST">
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>`;
            tbody.appendChild(row);
        });
    };

    sortButtons.forEach(button => {
        button.addEventListener('click', () => {
            const field = button.dataset.field;
            direction = direction === 'asc' ? 'desc' : 'asc'; // инвертирование направления сортировки
            const url = `/polls?sort=${field}&dir=${direction}`; // добавление направления сортировки в URL
            fetch(url, {method: "POST"})
                .then(response => response.json())
                .then(polls => {
                    updateTable(polls);
                });
        });
    });

    fetch('/polls', {method: "POST"})
        .then(response => response.json())
        .then(polls => {
            updateTable(polls);
        });
</script>

