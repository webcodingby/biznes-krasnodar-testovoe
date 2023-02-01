function getTasksAjax()
{
    $.ajax({
        type: ('GET'),
        url: ('api/tasks'),
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
}

function postTask()
{
    if($('#active')[0].checked){
        $('#active').val(1)
    }else{
        $('#active').val(0)
    }
    $.ajax({
        type: ('POST'),
        url: ('/api/task/'),
        data: {
            user_id: $('#user_id').val(),
            task: $('#task').val(),
            date: $('#date').val(),
            active: $('#active').val(),
            done: $('#done').val(),
        },
        success: function (data) {
            if (confirm("Вы добавили задачу")) {
                //location.reload();
            }else{
                //location.reload();
            }
        },
        error: function (data) {
            console.log('An error occurred.');
            console.log(data);
        },
    });
}

function deleteTask(id)
{
    if (confirm("Вы уверены что хотите удалить задачу?")) {
        $.ajax({
            type: ('DELETE'),
            url: (`/api/task/${id}`),
            data: {
                id: id,
            },
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
    }
}

function editTask(id)
{
    if (confirm("Вы уверены что хотите удалить задачу?")) {
        $.ajax({
            type: ('PATCH'),
            url: (`/api/task/${id}`),
            data: {
                id: id,
            },
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
    }
}

function okTask(id)
{
    if (confirm("Вы уверены что хотите выполнить задачу?")) {
        $.ajax({
            type: ('PATCH'),
            url: (`/api/task/${id}`),
            data: {
                "id": id,
                "done": 1,
            },
            success: function (data) {
                //location.reload();
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
    }
}

function saveTask(id)
{
    $('#task').val()
    $('#date').val()
    if (confirm("Сохранить изменения?")) {
        $.ajax({
            type: ('PATCH'),
            url: (`/api/task/${id}`),
            data: {
                id: id,
                user_id: $('#user_id').val(),
                task: $('#task').val(),
                date: $('#date').val(),
                active: $('#active').val(),
                complited: $('#complited').val(),
            },
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
    }
}

function authLogin()
{
    let email = $('#email').val();
    $.ajax({
        url: '/auth',         /* Куда отправить запрос */
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
}