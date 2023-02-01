<?php


namespace App\Api;

use App\Core\DataBase;

class TaskControllers
{
    public static function getTasks()
    {
        $tasks = DataBase::getRequest("tasks");
        echo json_encode($tasks);
        die();
    }

    public static function setTask($data){
        $task = $data['task'];
        $date = $data['date'];
        $user_id = (int)$data['user_id'];
        $active = $data['active'] ?? '0';
        $active = (int)$active;
        $complited = $data['complited'] ?? '0';
        $complited = (int)$complited;
        if(empty($task)){
            http_response_code(404);
            $res = [
                'status' => false,
                'message' => 'Заполните поле задача',
                'input' => 'task'
            ];
            echo json_encode($res);
            die();
        }

        if(empty($date)){
            http_response_code(404);
            $res = [
                'status' => false,
                'message' => 'Заполните дату',
                'input' => 'date'
            ];
            echo json_encode($res);
            die();
        }

        $affectedRowsNumber = DataBase::insertTask($task, $date, $user_id, $active, $complited);

        http_response_code(201);

        $res = [
            'status' => true,
            'post_id' => $affectedRowsNumber,
        ];

        echo json_encode($res);
    }

    public static function editTask($data){
        $id = $data['id'];
        $task = $data['task'];
        $date = $data['date'];
        $user_id = $data['id'];
        $active = $data['active'];
        $complited = $data['complited'];

        $dataDb = DataBase::getTask($data['id']);
        if($dataDb){
            $data = DataBase::updateTask($data);

            http_response_code(200);

            $res = [
                'status' => true,
                'message' => 'Task update',
            ];

            echo json_encode($res);
            die();
        }else{
            http_response_code(404);

            $res = [
                'status' => false,
                'message' => 'Task not found',
            ];

            echo json_encode($res);
            die();
        }

    }

    public static function deleteTask($id){
        $dataDb = DataBase::getRow("SELECT * FROM `tasks` WHERE `id` = $id");
        $dataDb = (int)$dataDb;
        if(!empty($dataDb)){

            $dataDb = DataBase::deleteTask($id);
            if($dataDb>0){
                http_response_code(200);
                $res = [
                    'status' => true,
                    'message' => $dataDb
                ];
                echo json_encode($res);
                die();
            }else{
                http_response_code(404);
                $res = [
                    'status' => false,
                    'message' => "Что-то пошло не так"
                ];
                echo json_encode($res);
                die();
            }

        }else{
            http_response_code(404);
            $res = [
                'status' => false,
                'message' => "Задача не найдена"
            ];
            echo json_encode($res);
            die();
        }
    }
}