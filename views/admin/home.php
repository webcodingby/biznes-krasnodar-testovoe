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
                <?php foreach ($data['result'] as $user):?>
                    <tr>
                        <td><?= $user['email'];?></td>
                        <?php if(!isset($user['count'])):?>
                            <td>0</td>
                        <?php else:?>
                            <td><?= $user['count'];?></td>
                        <?php endif;?>
                    </tr>
                <?php endforeach?>
            </tbody>
            <?php if($data['page'] > 1):?>
                <div style="text-align: center">
                    <?php for ($pageNum = 1; $pageNum <= $data['page']; $pageNum++): ?>
                        <a href="?page=<?= $pageNum === 1 ? '' : $pageNum ?>"><?= $pageNum ?></a>
                    <?php endfor; ?>
                </div>
            <?php endif;?>
        </table>
    </div>
</div>
<?php
Page::part('footer');
?>