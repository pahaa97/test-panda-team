<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Ошибка!</h4>
    <p>
        <?php
        if (isset($errors)) {
            $errors = json_decode($errors);
            echo implode('<br>', $errors->errors);
        }
        ?>
    </p>
</div>
