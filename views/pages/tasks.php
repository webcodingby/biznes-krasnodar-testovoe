<?php

use App\Core\Page;
use App\Core\Router;

if(!$_SESSION['id']){
    Router::redirect('/');
}
Page::part('head', 'Задачи');
Page::part('nav', 'Задачи', $data['user']);
?>
<div class="container">
    <div class="row mb-3">
        <h2 class="mb-4">Пользователь: <?= $data['user']['email']?></h2>
        <div class="mb-4 col-12 d-flex align-items-center" id="task_form">
            <input class="form-check-input" type="hidden" value="<?=$data['user']['id']?>" name="user_id" id="user_id">
            <div class="col-5 me-2">
                <label for="task" class="form-label">Задача:</label>
                <input type="text" name="task" class="form-control" id="task" required>
            </div>
            <div class="col-3 ms-2">
                <label for="date" class="form-label">Дата:</label>
                <input type="date" name="date" class="form-control" id="date" required>
            </div>
            <div class="form-check col-2 d-flex justify-content-center align-items-center">
                <input class="form-check-input m-3" type="checkbox" value="0" id="active">
                <label class="form-check-label" for="active">
                    Важное
                </label>
            </div>
            <div class="form-check hidden col-2 d-flex justify-content-center align-items-center">
                <input class="form-check-input m-3" type="checkbox" value="0" id="complited">
                <label class="form-check-label" for="complited">
                    Выполнено
                </label>
            </div>
            <div class="col-2 d-flex justify-content-center align-items-center">
                <div id="task_btn" onclick="postTask()" class="btn btn-primary mt-2 d-flex justify-content-center align-content-center">Добавить</div>
            </div>
        </div>
    </div>
    <div class="row">
        <h3>Задачи</h3>
        <?php if(!empty($data['data'])):?>
            <table class="table">
                <thead>
                    <tr >
                        <th scope="col">Задача</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Редактировать</th>
                        <th scope="col">Выполнено</th>
                        <th scope="col">Удалить</th>
                    </tr>
                </thead>
                <tbody id="table_tasks">
                    <?php foreach ($data['data'] as $task):?>
                        <?php
                            $task['active'] = ($task['active']) ? 'table-primary' : '';
                            $task['done'] = ($task['done']) ? 'text-decoration-line-through' : '';
                        ?>
                        <tr class="task-wrap <?= $task['active']?> <?=$task['done']?>">
                            <td>
                                <span class="task-text"><?= $task['task']?></span>
                                <input type="text" class="hidden input-task" value="<?= $task['task']?>">
                            </td>
                            <td>
                                <span class="task-date"><?= $task['date']?></span>
                                <input type="date" class="hidden input-date" value ="<?= $task['date']?>">
                            </td>
                            <td>
                                <button class="btn btn-warning btn-edit" onclick="editTask(<?= $task['id']?>)">
                                    Редактировать
                                </button>
                                <button class="btn btn-info btn-ok hidden" onclick="saveTask(<?= $task['id']?>)">
                                    Сохранить
                                </button>
                            </td>
                            <td>
                                <label class="form-check-label" for="task-complited">
                                    <button class="btn btn-success btn-complited" onclick="okTask(<?= $task['id']?>)">
                                        Выполнено
                                    </button>
                                </label>
                                <input class="form-check-input m-3 hidden" type="checkbox" value="0" id="task-complited">
                            </td>
                            <td>
                                <button class="btn btn-danger bnt-delete" onclick="deleteTask(<?= $task['id']?>)">
                                    Удалить
                                </button>
                            </td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
            <?php if($data['pagesCount'] > 1):?>
                <div style="text-align: center">
                    <?php for ($pageNum = 1; $pageNum <= $data['pagesCount']; $pageNum++): ?>
                        <a href="<?= $pageNum === 1 ? '/tasks' : '?page='.$pageNum ?>"><?= $pageNum ?></a>
                    <?php endfor ?>
                </div>
            <?php endif?>
        <?php else:?>
            <span>Добавьте задачи</span>
        <?php endif ?>
    </div>
</div>
<?php
Page::part('footer');
?>

