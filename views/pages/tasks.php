<?php

use App\Api\UserControllers;
use App\Core\Page;
$count = 0;
$user = 'Test';
$class = '';
$compl = '';
Page::part('head', 'Задачи');
Page::part('nav');
?>
<div class="container">
    <h2 class="mb-4">Задачи пользователя: <?= $user; ?></h2>
    <form method="POST" class="mb-4" id="task_form">
        <div class="row mb-3">
            <div class="col-3">
                <label for="task" class="form-label">Task:</label>
                <input type="text" name="task" class="form-control" id="task" required>
            </div>
            <div class="col-3">
                <label for="date" class="form-label">Date:</label>
                <input type="date" name="date" class="form-control" id="active" required>
            </div>
            <div class="mb-3 col-1">
                <input class="form-check-input" type="checkbox" value="" id="active">
                <label class="form-check-label" for="active">
                    Active
                </label>
            </div>
            <div class="mb-3 col-1">
                <button type="button" id="task_btn" class="btn btn-primary">Add</button>
            </div>
        </div>
        <div class="row">
            <h3>List Task</h3>
            <table class="table">
                <thead>
                    <tr >
                        <th scope="col">id</th>
                        <th scope="col">Task</th>
                        <th scope="col">Date</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Comlit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task):?>
                        <?php
                            $count++;
                            if($task['active']){
                                $class = 'table-primary';
                            }
                            if($task['complited']){
                                $compl = 'table-warning';
                            }
                        ?>
                        <tr class="<?= $class;?> <?= $compl;?>">
                            <th><?= $count;?></th>
                            <td><?= $task['text'];?></td>
                            <td><?= $task['date'];?></td>
                            <td><button>Delete</button></td>
                            <td><button>Edit</button></td>
                            <td><button>Comlit</button></td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </form>
</div>
<?php
Page::part('footer');
?>

