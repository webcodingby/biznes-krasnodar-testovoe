<?php


namespace App\Api;


use App\Controllers\MainControllers;
use App\Controllers\TasksControllers;
use App\Controllers\ValidateInput;
use App\Core\DataBase;
use App\Core\Page;
use App\Core\Router;
use http\Header;

class UserControllers
{
    public static function post($data)
    {
        $data['status'] = ValidateInput::validateEmail($data);
        if($data['status'] != 'ok'){
            echo 'error';
            die();
        }else{
            session_start();
            $email = $data['email'];
            $id = DataBase::getValue("SELECT `id` FROM `users` WHERE `email`='$email'");
            if($id){
                $_SESSION['id'] = $id;
                echo '/tasks';
                die();
            }else{
                $insert = DataBase::add("INSERT INTO `users` SET `email` = ?", $email);
                $_SESSION['id'] = $insert;
                echo '/tasks';
                die();
            }
        }
    }

    public static function authLogin($data, $params)
    {
        $validateResult = ValidateInput::validateEmail($data);
        $email = $data['email'];
        $db = new DataBase();
        $stmt = $db->getRow('users','WHERE email = ?', $data);
        $stmt->execute(array($data['email']));

    }
}