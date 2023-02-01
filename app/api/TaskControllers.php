<?php


namespace App\Api;

use App\Core\DataBase;
use JetBrains\PhpStorm\NoReturn;

class TaskControllers
{
    /**
     * @throws \JsonException
     */
    #[NoReturn] public static function getTasks(): void
    {
        $tasks = DataBase::getRequest("tasks");
        echo json_encode($tasks, JSON_THROW_ON_ERROR);
        die();
    }

    /**
     * @throws \JsonException
     */
    #[NoReturn] public static function setTask($data): void
    {

        $task = $data['task'];
        $date = $data['date'];
        $user_id = (int)$data['user_id'];
        $active = $data['active'] ?? '0';
        $active = (int)$active;
        $done = $data['done'] ?? '0';
        $done = (int)$done;
        if(empty($task)){
            http_response_code(404);
            $res = [
                'status' => false,
                'message' => 'Заполните поле задача',
                'input' => 'task'
            ];
            echo json_encode($res, JSON_THROW_ON_ERROR);
            die();
        }

        if(empty($date)){
            http_response_code(404);
            $res = [
                'status' => false,
                'message' => 'Заполните дату',
                'input' => 'date'
            ];
            echo json_encode($res, JSON_THROW_ON_ERROR);
            die();
        }

        $affectedRowsNumber = DataBase::insertTask($task, $date, $user_id, $active, $done);

        http_response_code(201);

        $res = [
            'status' => true,
            'post_id' => $affectedRowsNumber,
        ];

        echo json_encode($res, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws \JsonException
     */
    #[NoReturn] public static function postTask($data): void
    {
        $task = $data['task'];
        $date = $data['date'];
        $user_id = (int)$data['user_id'];
        $active = $data['active'] ?? '0';
        $active = (int)$active;
        $done = $data['done'] ?? '0';
        $done = (int)$done;

        $affectedRowsNumber = DataBase::insertTask($task, $date, $user_id, $active, $done);

        http_response_code(201);

        $res = [
            'status' => true,
            'post_id' => $affectedRowsNumber,
        ];

        echo $affectedRowsNumber;
    }

    /**
     * @throws \JsonException
     */
    #[NoReturn] public static function updateTask($form, $id): void
    {
        $dataDb = DataBase::getTask($id);
        $formNew = array_merge($dataDb[0], $form);

        if($form){
            $data = DataBase::updateTask($formNew, $id);
            if($data){
                http_response_code(200);
                $res = [
                    'status' => true,
                    'message' => $data,
                ];
                echo json_encode($res, JSON_THROW_ON_ERROR);
                die();
            }
            http_response_code(404);
            $res = [
                'status' => false,
                'message' => 'Задача не обновилась, по пробуйте еще раз',
            ];
            echo json_encode($res, JSON_THROW_ON_ERROR);
            die();
        }
        http_response_code(404);
        $res = [
           'status' => false,
           'message' => 'Задача не найдена',
        ];
        echo json_encode($res, JSON_THROW_ON_ERROR);
        die();

    }


    #[NoReturn] public static function deleteTask($id): void
    {
        $dataDb = DataBase::getTask($id);
        $dataDb = (int)$dataDb;
        if(!empty($dataDb)){

            $dataDb = DataBase::deleteTask($id);
            if($dataDb>0){
                http_response_code(200);
                $res = [
                    'status' => true,
                    'message' => $dataDb
                ];
            }else{
                http_response_code(404);
                $res = [
                    'status' => false,
                    'message' => "Что-то пошло не так"
                ];
            }
            echo json_encode($res);
            die();

        }

        http_response_code(404);
        $res = [
            'status' => false,
            'message' => "Задача не найдена"
        ];
        echo json_encode($res, JSON_THROW_ON_ERROR);
        die();
    }

    /**
     * @throws \JsonException
     */
    #[NoReturn] public static function getTask($id): bool|string
    {
        $dataDb = DataBase::getTask($id);
        if($dataDb){
            $res = json_encode($dataDb, JSON_THROW_ON_ERROR);
            echo $res;
            die();
        }

        http_response_code(404);
        $res = [
            'status' => false,
            'message' => "Задача не найдена"
        ];
        echo json_encode($res, JSON_THROW_ON_ERROR);
        die();

    }
}