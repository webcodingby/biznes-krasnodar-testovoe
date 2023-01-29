<?php

use App\Api\UserControllers;
use App\Controllers\AdminControllers;
use App\Core\Page;

Page::part('head', '404 - такой страницы не существует');
Page::part('nav');
?>
<div class="container">
    <h2 class="mb-4">404 - Page Not Found</h2>
</div>
<?php
    Page::part('footer');
?>
