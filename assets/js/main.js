function getTasksAjax(){
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

function postTask(){
    $.ajax({
        type: ('POST'),
        url: ('/api/task'),
        data: {
            user_id: $('#user_id').val(),
            task: $('#task').val(),
            date: $('#date').val(),
            active: $('#active').val(),
            complited: $('#complited').val(),
        },
        success: function (data) {
            if (confirm("Вы добавили задачу")) {
                location.reload();
            }else{
                location.reload();
            }
        },
        error: function (data) {
            console.log('An error occurred.');
            console.log(data);
        },
    });
}

function deleteTask(id){
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