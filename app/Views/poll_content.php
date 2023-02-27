<div class="container mt-4">
    <h1><?php echo $title ?? ''; ?></h1>
    <form id="edit-poll-form"
          method="POST"
          action="/polls/<?php echo (isset($pull_id)) ? ($pull_id."/update") : 'create';?>">
        <?php if (isset($type) && $type == 'edit'): ?>
        <input type="hidden" name="poll_id" value="<?php echo $pull_id ?? ''; ?>">
        <?php endif; ?>
        <div class="form-group">
            <label for="title">Название опроса</label>
            <input type="text"
                   class="form-control"
                   name="title"
                   placeholder="Введите название опроса"
                   value="<?php echo $poll->title ?? ''; ?>">
            <div id="title-error" class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="status">Статус</label>
            <select name="status" class="form-control">
                <option <?php echo (isset($poll) && $poll->status == 'draft') ? 'selected' : ''; ?> value="draft">Draft</option>
                <option <?php echo (isset($poll) && $poll->status == 'published') ? 'selected' : ''; ?> value="published">Published</option>
            </select>
            <div id="status-error" class="invalid-feedback"></div>
        </div>
        <div class="card mb-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Варианты ответа</h4>
            </div>
            <div class="card-body">
                <div id="question-list">
                    <?php
                    if (isset($options) && $options !== []):
                    foreach ($options as $option): ?>
                    <div class="form-row mb-3 question-row">
                        <div class="col-12 col-md-6">
                            <input type="text"
                                   class="form-control"
                                   name="text[]"
                                   value="<?php echo $option['text'] ?>"
                                   placeholder="Введите вариант ответа">
                            <div id="text-error" class="invalid-feedback"></div>
                        </div>
                        <div class="col-6 col-md-4">
                            <input type="number"
                                   class="form-control"
                                   name="votes[]"
                                   value="<?php echo $option['votes'] ?>"
                                   placeholder="Количество ответов">
                            <div id="votes-error" class="invalid-feedback"></div>
                        </div>
                        <div class="col-6 col-md-2">
                            <button type="button" class="btn btn-danger remove-question-btn">Удалить</button>
                        </div>
                    </div>
                    <?php endforeach; else: ?>
                    <div class="form-row mb-3 question-row">
                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control" name="text[]" placeholder="Введите вариант ответа">
                            <div id="text-error" class="invalid-feedback"></div>
                        </div>
                        <div class="col-6 col-md-4">
                            <input type="number" class="form-control" name="votes[]" placeholder="Количество ответов">
                            <div id="votes-error" class="invalid-feedback"></div>
                        </div>
                        <div class="col-6 col-md-2">
                            <button type="button" class="btn btn-danger remove-question-btn">Удалить</button>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <button type="button" id="add-question-btn" class="btn btn-primary">Добавить вопрос</button>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-3">Сохранить</button>
    </form>
</div>

