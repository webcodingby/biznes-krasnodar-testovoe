<?php

use App\Api\UserControllers;
use App\Core\Page;

if(!$_SESSION['id']){
    \App\Core\Router::redirect('/');
}
Page::part('head', 'Задачи');
Page::part('nav', 'Задачи', $data['user']);
?>
<div class="container">
    <div class="row mb-3">
        <h2 class="mb-4">Пользователь: <?= $data['user']['email']; ?></h2>
        <div class="mb-4 col-12 d-flex align-content-center" id="task_form">
            <input class="form-check-input" type="hidden" value="<?=$_SESSION['id'];?>" name="user_id" id="user_id">
            <div class="col-4">
                <label for="task" class="form-label">Задача:</label>
                <input type="text" name="task" class="form-control" id="task" required>
           </div>
           <div class="col-4">
                <label for="date" class="form-label">Дата:</label>
                <input type="date" name="date" class="form-control" id="date" required>
           </div>
           <div class="mb-3 col-2 d-flex justify-content-center align-content-center">
                <input class="form-check-input" name="active" type="checkbox" value="0" id="active">
                <label class="form-check-label" for="active">
                   Важное
                </label>
           </div>
            <div class="w-100">
                <div id="task_btn" class="btn btn-primary mt-2 d-flex justify-content-center align-content-center">Добавить</div>
            </div>
        </div>
    </div>

    <script>
        var frm = $('#task_form');
        $('#task_btn').click(function(){
            $.ajax({
                type: ('POST'),
                url: ('/api/task/post'),
                data: {
                    user_id: $('#user_id').val(),
                    task: $('#task').val(),
                    date: $('#date').val(),
                    active: $('#active').val(),
                },
                success: function (data) {
                    console.log('Submission was successful.');
                    console.log(data);
                },
                error: function (data) {
                    console.log('An error occurred.');
                    console.log(data);
                },
            });
        })
    </script>

    <div class="row">
        <h3>Задачи</h3>
        <?php if(!empty($data['data'])):?>
            <table class="table">
                <thead>
                    <tr >
                        <th scope="col">Задача</th>
                        <th scope="col">Дата</th>
                        <th scope="col">Удалить</th>
                        <th scope="col">Редактировать</th>
                        <th scope="col">Выполнено</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['data'] as $task):?>
                        <?php
                            $task['active'] = ($task['active']) ? 'table-primary' : '';
                            $task['complited'] = ($task['complited']) ? 'text-decoration-line-through' : '';
                        ?>
                        <tr class="<?= $task['active'];?> <?=  $task['complited'];?>">
                            <td><?= $task['task'];?></td>
                            <td><?= $task['date'];?></td>
                            <td><button class="btn btn-danger">Удалить</button></td>
                            <td><button class="btn btn-primary">Редактировать</button></td>
                            <td><button class="btn btn-success">Выполнено</button></td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
            <?php if($data['pagesCount'] > 1):?>
                <div style="text-align: center">
                    <?php for ($pageNum = 1; $pageNum <= $data['pagesCount']; $pageNum++): ?>
                        <a href="?page=<?= $pageNum === 1 ? '' : $pageNum ?>"><?= $pageNum ?></a>
                    <?php endfor; ?>
                </div>
            <?php endif;?>
        <?php else:?>
            <span>Добавьте задачи</span>
        <?php endif; ?>
    </div>
</div>
<?php
Page::part('footer');
?>

