<?php

use App\Api\UserControllers;
use App\Core\Page;
$count = 0;
$user = 'Test';
$class = '';
$compl = '';
Page::part('head');
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
<script
    src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
    crossorigin="anonymous"></script>
<script>

    $('#form_btn').on('click', function (){
        var email = $('#email').val();
        $.ajax({
            url: '/api/validate',         /* Куда отправить запрос */
            method: 'post',             /* Метод запроса (post или get) */
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: $('#form_auth').serialize(),     /* Данные передаваемые в массиве */
            success: function(data){
                $('.error_email').addClass('hidden')
                if(data != 'ok'){
                    $('.error_email').removeClass('hidden')
                }else{
                    $.post('/api/auth', {email: email}, function(data){
                        console.log(data);
                    });
                }
            },
            error: function (data, exception) {

            }
        });
    })

</script>
<?php
Page::part('footer');
?>

