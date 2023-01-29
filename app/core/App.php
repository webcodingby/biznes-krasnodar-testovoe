<?php


namespace App\Core;

class App
{
    public static function start()
    {
        self::libs();
        $db = new Database();
        $db->getDbh();
        session_start();
        var_dump($_SESSION);
    }

    public static function libs()
    {
        $config = require_once 'config/app.php';
        foreach ($config['libs'] as $lib)
        {
            require_once "libs/" . $lib . ".php";
        }
    }
}