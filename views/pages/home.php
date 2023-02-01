<?php

use App\Api\UserControllers;
use App\Core\Page;

    Page::part('head', 'Вход');
    Page::part('nav', 'Вход');
?>
    <div class="container">
        <h2 class="mb-4">Вход</h2>
        <div class="mb-4 w-50" id="form_auth">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" id="email" required>
                <span class="error_email hidden">Не правильный email</span>
                <style>
                    .hidden{
                        display: none;
                    }
                </style>
            </div>
            <div id="form_btn" onclick="authLogin()" class="btn btn-primary">Ok</div>
        </div>
    </div>
<?php
    Page::part('footer');
?>

