<?php
(!$_SESSION['id']) ? \App\Core\Router::redirect('/') : '';
$roleId = ($_SESSION['id']) ? \App\Core\DataBase::getValue("SELECT `role_id` FROM `users` WHERE `id`='".$_SESSION['id']."'") : '';
($roleId != 2) ? \App\Core\Router::redirect('/tasks') : '';

use App\Api\UserControllers;
use App\Controllers\AdminControllers;
use App\Core\Page;

$count = 0;

Page::part('head', 'Панель администратора');
Page::part('nav', 'Панель администратора', $data['user']);
?>
<div class="container">
    <h2 class="mb-4">Привет, admin: <?= $data['user']['email']; ?></h2>
    <a href="/tasks">Ваши задачи</a>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Количество задач</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['data'] as $user):?>
                    <tr>
                        <td><?= $user['email'];?></td>
                        <td><?= $user['count'];?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>
<?php
Page::part('footer');
?>