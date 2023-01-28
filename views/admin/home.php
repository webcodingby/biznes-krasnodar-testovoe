<?php

use App\Api\UserControllers;
use App\Controllers\AdminControllers;
use App\Core\Page;
$user = 'WCBDY';
Page::part('head');
Page::part('nav');
?>
<div class="container">
    <h2 class="mb-4">Hello, admin: <?= $user; ?></h2>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Email</th>
                    <th scope="col">Count Task</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user):?>
                        <tr>
                            <th><?= $user['id'];?></th>
                            <td><?= $user['email'];?></td>
                            <td><?= $user['role_id'];?></td>
                        </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>
<?php
Page::part('footer');
?>