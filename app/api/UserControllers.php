<?php


namespace App\Api;


use App\Controllers\MainControllers;
use App\Controllers\TasksControllers;
use App\Controllers\ValidateInput;
use App\Core\DataBase;
use App\Core\Page;
use App\Core\Router;
use http\Header;
use JetBrains\PhpStorm\NoReturn;

class UserControllers
{
    /**
     * @throws \JsonException
     */
    public static function post($data):void
    {

        $data['status'] = ValidateInput::validateEmail($data);
        $data['redirect'] = '';
        if($data['status'] !== 'ok'){
            echo 'error';
        }else{
            session_start();
            $email = $data['email'];
            $user = DataBase::getValue("SELECT `id` FROM `users` WHERE `email`='$email'");

            if($user){
                $_SESSION['id'] = $user;
                $roleId = DataBase::getValue("SELECT `role_id` FROM `users` WHERE `email`='$email'");
                ((int)$roleId === 2) ? $data['redirect'] = '/admin' : $data['redirect'] = '/tasks';
            }else{
                $data = [
                    "email" => $data['email'],
                    "role_id" => 1,
                ];
                $insert = DataBase::insert($data,"users (email, role_id)", "(:email, :role_id)");

                $_SESSION['id'] = $insert;
                $data['redirect'] = '/tasks';
            }

            echo $data['redirect'];
        }
        die();
    }


    public static function logout():void
    {
        unset($_SESSION['id']);
        Router::redirect('/');
    }
}