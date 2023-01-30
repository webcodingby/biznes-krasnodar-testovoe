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
            <div form="form_auth" id="form_btn" class="btn btn-primary">Ok</div>
        </div>
    </div>

<script>

$('#form_btn').on('click',function (){
    var email = $('#email').val();
    $.ajax({
        url: 'auth',         /* Куда отправить запрос */
        method: 'post',           /* Тип данных в ответе (xml, json, script, html). */
        data: {email: email},     /* Данные передаваемые в массиве */
        success: function(data){
            if(data != 'error'){
                $('.error_email').addClass('hidden');
                window.location.href= data;
            }else{
                $('.error_email').removeClass('hidden');
            }
        },
        error: function(jqXHR, textStatus, errorMessage) {
            console.log(errorMessage); // Optional
        },
    });
})

</script>
<?php
    Page::part('footer');
?>

