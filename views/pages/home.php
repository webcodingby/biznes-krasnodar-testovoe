<?php

use App\Api\UserControllers;
use App\Core\Page;

    Page::part('head', 'Вход');
    Page::part('nav');
?>
    <div class="container">
        <h2 class="mb-4">Вход</h2>
        <form method="POST" class="mb-4 w-50" id="form_auth">
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
            <button type="button" id="form_btn" class="btn btn-primary">Ok</button>
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
        url: '/api/auth',         /* Куда отправить запрос */
        method: 'post',             /* Метод запроса (post или get) */
        dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
        data: $('#form_auth').serialize(),     /* Данные передаваемые в массиве */
        success: function(data){
            $('.error_email').addClass('hidden');
            if(data != 'error'){
                window.location.href= data;
            }
            $('.error_email').removeClass('hidden');
        },
        error: function (data, exception) {
            console.log(exception)
        }
    });
})

</script>
<?php
    Page::part('footer');
?>

