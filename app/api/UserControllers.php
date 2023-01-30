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
    public static function post($data, $roleId = '')
    {
        $data['status'] = ValidateInput::validateEmail($data);
        $data['redirect'] = '';
        if($data['status'] != 'ok'){
            echo 'error';
            die();
        }else{
            session_start();
            $email = $data['email'];
            $id = DataBase::getValue("SELECT `id` FROM `users` WHERE `email`='$email'");
            if($id){
                $_SESSION['id'] = $id;
                ($roleId == 2) ? $data['redirect'] = '/admin' : $data['redirect'] = '/tasks';
            }else{
                $insert = DataBase::add("INSERT INTO `users` SET `email` = ?", $email);
                $_SESSION['id'] = $insert;
            }
            echo $data['redirect'];
            die();
        }
    }


    public static function logout($uri){
        session_destroy();
        $uri = '/';
        echo $uri;
    }
}