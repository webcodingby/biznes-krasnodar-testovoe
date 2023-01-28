<?php


namespace App\Api;


use App\Controllers\MainControllers;
use App\Controllers\TasksControllers;
use App\Controllers\ValidateInput;
use App\Core\DataBase;
use App\Core\Page;
use App\Core\Router;
use http\Header;

class UserControllers extends ValidateInput
{
    public static function post($data)
    {
        $email = $data['email'];
        $db = new DataBase();
        Router::redirect('/tasks');
    }

    public static function authLogin($data, $params)
    {
        $validateResult = ValidateInput::validateEmail($data);
        $db = new DataBase();
        $stmt = $db->query('SELECT name FROM users WHERE email = ?', $params);
        $stmt->execute(array($data['email']));

    }
}