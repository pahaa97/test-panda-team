$(document).ready(function() {
    console.log('ready');
    // Добавление нового вопроса
    jQuery('#add-question-btn').click(function() {
        clearForm();
        var newQuestionRow = $('.question-row').first().clone();
        newQuestionRow.find('input').val('');
        $('#question-list').append(newQuestionRow);
    });

    // Удаление опроса
    $(document).on('click', '.remove-question-btn', function() {
        if ($('#question-list .question-row').length > 1) {
            $(this).closest('.question-row').remove();
        }
    });


    // Отправка данных формы на сервер
    $('#edit-poll-form').submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var formData = form.serializeArray();
        clearForm();
        console.log(form.attr('action'));

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: JSON.stringify(formData),
            contentType: 'application/json',
            success: function(response) {
                window.location.href = '/polls';
            },
            error: function(error) {
                const errors = JSON.parse(error.responseText).errors;
                if (errors) {
                    for (const [fieldName, errorMessages] of Object.entries(errors)) {
                        if (fieldName === 'options') {
                            for (const [index,value] of Object.entries(errors.options)) {
                                const text = document.querySelectorAll(`[name='text[]']`);
                                const votes = document.querySelectorAll(`[name='votes[]']`);
                                text[index].classList.add('is-invalid');
                                votes[index].classList.add('is-invalid');
                                const errorsText = document.querySelectorAll(`#text-error`);
                                const errorsVotes = document.querySelectorAll(`#votes-error`);
                                if (value['text']) {
                                    errorsText[index].textContent = value['text'].join('. ');
                                }
                                if (value['votes']) {
                                    errorsVotes[index].textContent = value['votes'].join('. ');
                                }
                            }
                        } else {
                            const field = document.querySelector(`[name=${fieldName}]`);
                            field.classList.add('is-invalid');
                            const errorContainer = document.querySelector(`#${fieldName}-error`);
                            errorContainer.textContent = errorMessages.join('. ');
                        }
                    }
                }
            }
        });
    });

    $('body').on('submit', '#delete-poll-form', function(event) {
        event.preventDefault();
        var form = $(this);
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: JSON.stringify(form.serializeArray()),
            contentType: 'application/json',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                // Перезагрузить страницу, чтобы увидеть изменения
                location.reload();
            },
            error: function(error) {
                console.log(error);
                alert('Ошибка при удалении опроса!');
            }
        });
    });
});

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
}
