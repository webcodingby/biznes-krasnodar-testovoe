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
                <input class="form-check-input m-3" type="checkbox" value="0" id="done">
                <label class="form-check-label" for="done">
                    Выполнено
                </label>
            </div>
            <div class="col-2 d-flex justify-content-center align-items-center">
                <div id="task_btn" onclick="postTask()" class="btn btn-primary mt-2 d-flex justify-content-center align-content-center">Добавить</div>
            </div>
        </div>
        <div class="mb-4 col-12 d-flex align-items-center hidden" id="edit-task_form">
            <input class="form-check-input" type="hidden" value="" id="id-edit">
            <input class="form-check-input" type="hidden" value="<?=$data['user']['id']?>" id="user_id-edit">
            <div class="col-5 me-2">
                <label for="task-edit" class="form-label">Задача:</label>
                <input type="text" name="task" class="form-control" id="task-edit" required>
            </div>
            <div class="col-3 ms-2">
                <label for="date-edit" class="form-label">Дата:</label>
                <input type="date" name="date" class="form-control" id="date-edit" required>
            </div>
            <div class="form-check col-2 d-flex flex-wrap align-items-center">
                <div class="d-flex align-items-center">
                    <input class="form-check-input m-3" type="checkbox" value="0" id="active-edit">
                    <label class="form-check-label" for="active-edit">
                        Важное
                    </label>
                </div>
                <div class="d-flex align-items-center">
                    <input class="form-check-input m-3" type="checkbox" value="0" id="done-edit">
                    <label class="form-check-label" for="done-edit">
                        Выполнено
                    </label>
                </div>
            </div>
            <div class="col-2 d-flex justify-content-center align-items-center">
                <div id="taskEdit_btn" onclick="saveTask()" class="btn btn-primary mt-2 d-flex justify-content-center align-content-center">Обновить</div>
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
                            $idInputValue = $task['id'];
                            $taskInputValue = $task['task'];
                            $dateInputValue = date('Y-m-d', strtotime($task['date']));
                            $activeInputValue = $task['active'];
                            $doneInputValue = $task['done'];
                            $active = ($task['active']) ? 'active-task' : '';
                            $valActive = ($task['active']) ? '0' : '1';
                            $done = ($task['done']) ? 'done-task' : '';
                            $valDone = ($task['done']) ? '0' : '1';
                            $task['date']= date('d.m.Y', strtotime($task['date']));
                        ?>
                        <tr class="task-wrap <?= $active?> <?=$done?>">
                            <td>
                                <span class="task-text"><?= $task['task']?></span>
                            </td>
                            <td>
                                <span class="task-date"><?= $task['date']?></span>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-edit"
                                        onclick="selectTask(
                                                    '<?=$idInputValue?>',
                                                    '<?=$taskInputValue?>',
                                                    '<?=$dateInputValue?>',
                                                    '<?=$activeInputValue?>',
                                                    '<?=$doneInputValue?>'
                                                )">
                                    Редактировать
                                </button>
                                <button class="btn btn-info btn-ok hidden" onclick="editTask(<?= $task['id']?>)">
                                    Сохранить
                                </button>
                            </td>
                            <td>
                                <label class="form-check-label" for="task-done">
                                    <button
                                            class="btn btn-success btn-done"
                                            onclick="okTask(<?= $task['id']?>)"
                                            data-done="<?=$valDone?>"
                                    >
                                        <?php if((int)$valDone === 0 ):?>
                                            Не выполнено
                                        <?php else: ?>
                                            Выполнено
                                        <?php endif ?>
                                    </button>
                                </label>
                                <input class="form-check-input m-3 hidden" type="checkbox" value="0" id="task-done">
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

