<?php


namespace App\Api;

use App\Core\DataBase;
use PDO;

class TaskControllers
{

    public static function post($data)
    {
        $data['error'] = 'ok';
        $active = (isset($data['active'])) ? $data['active'] : '0';
        if(empty($data['task']) || empty($data['date'])){
            $data['error'] = 'error';
            echo $data['error'];
            die();
        }
        $param = [
            'user_id' =>$data['user_id'],
            'task' => $data['task'],
            'date' => $data['date'],
            'active' => $active,
        ];
        $insert = DataBase::insert('tasks', 'task,date,user_id,active','Ntcnjdfz pfgbcm', '2023-20-01', '5', '0');
        //$insert = DataBase::add("INSERT INTO `tasks` (`task`,`date`,`user_id`,`active`) VALUES('Ntcnjdfz pfgbcm','2023-20-01','5','0') ");
        //$insert = DataBase::add("INSERT INTO `tasks` SET 'task,user_id,date' = ?", $param);
        var_dump($insert);
        die();
    }

    public static function getTasks($data){
        $data = DataBase::getAll("SELECT * FROM `tasks`");
        echo json_encode($data);
        die();
    }

    public static function getTask($id){
        $dataDb = DataBase::getRow("SELECT * FROM `tasks` WHERE `id` = $id");
        if($dataDb){
            echo json_encode($dataDb);
            die();
        }else{
            http_response_code(404);
            $res = [
                'status' => false,
                'message' => "Task not found"
            ];
            echo json_encode($res);
            die();
        }
    }

    public static function setTask($data){
        $task = $data['task'];
        $date = $data['date'];
        $user_id = (int)$data['user_id'];
        $active = (int)$data['active'];
        var_dump($task,$date,$user_id,$active);
        $affectedRowsNumber = DataBase::insertTask($task, $date, $user_id, $active);

        //$dataDb = DataBase::add("INSERT INTO `tasks` SET `task` = ?", 'Test');
        //$dataDb = DataBase::add("INSERT INTO `tasks` SET `id`,`task`,`date`,`user_id`,`active = ?`, NULL,$task,$date,$user_id,$active");
        http_response_code(201);

        $res = [
            'status' => true,
            'post_id' => $affectedRowsNumber,
        ];

        echo json_encode($res);
    }

    public static function editTask($data, $id){
        if($data) {
            $task = $data['task'];
            $date = $data['date'];
            $user_id = $_SESSION['id'];
            $active = $data['active'];
        }

        $dataDb = DataBase::getRow("SELECT * FROM `tasks` WHERE `id` = $id");
        if($dataDb){
            $data = DataBase::add("UPDATE FROM `tasks` WHERE `tasks`.`id` = $id");
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
        if($dataDb){

            http_response_code(404);
            $res = [
                'status' => false,
                'message' => "Task not found"
            ];
            echo json_encode($res);
            die();
        }else{
            http_response_code(404);
            $res = [
                'status' => false,
                'message' => "Task not found"
            ];
            echo json_encode($res);
            die();
        }
    }
}