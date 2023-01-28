<?php

namespace App\Controllers;

use App\Core\DataBase;

class Auth extends ValidateInput
{
    public static function authLogin($data, $params)
    {
        ValidateInput::validateEmail($data);
        $db = new DataBase();
        $stmt = $db->query('SELECT name FROM users WHERE email = ?', $params);
        $stmt->execute(array($data['email']));

    }
}