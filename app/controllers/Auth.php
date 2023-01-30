<?php

namespace App\Controllers;

use App\Core\DataBase;
use App\Core\Router;

class Auth
{
    public static function logout()
    {
        unset($_SESSION['id']);
        Router::redirect('/');
    }
}