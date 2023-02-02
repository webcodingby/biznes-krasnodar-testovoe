let id = null;
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
                location.reload();
            }else{
                alert('Произошла ошибка на сервере. Попробуйте еще раз')
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
    if (confirm("Вы уверены что хотите изменить задачу?")) {
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

function formData(){
    let formData = new FormData();
    formData.append('id', $('#id').val());
    formData.append('user_id', $('#user_id').val());
    formData.append('task', $('#task').val());
    formData.append('date', $('#date').val());
    formData.append('active', $('#active').val());
    formData.append('done', $('#done').val());
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
                location.reload();
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
    }
}
function selectTask(id, task, date, active, done)
{
    id=id;
    $('#edit-task_form').removeClass('hidden');
    $('#task_form').addClass('hidden');
    $('#id-edit').val(id);
    $('#task-edit').val(task);
    $('#date-edit').val(date);
    $('#active-edit').val(active);
    if(+$('#active-edit').val() === 1)
    {
        $('#active-edit').prop('checked', true);
    }else{
        $('#active-edit').prop('checked', false);
    }
    $('#done-edit').val(done);
    if(+$('#done-edit').val() === 1)
    {
        $('#done-edit').prop('checked', true);
    }else{
        $('#done-edit').prop('checked', false);
    }
    let attr = $('#taskEdit_btn').attr('onclick', `saveTask(${id})`);
    console.log(attr);
}

function saveTask(id)
{
    id = $('#id-edit').val();
    const data = {
        id: id,
        user_id: $('#user_id-edit').val(),
        task: $('#task-edit').val(),
        date: $('#date-edit').val(),
        active: $('#active-edit').val(),
        done: $('#done-edit').val(),
    }
    if (confirm("Сохранить изменения?")) {
        $.ajax({
            type: ('PATCH'),
            url: (`/api/task/${id}`),
            data: data,
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