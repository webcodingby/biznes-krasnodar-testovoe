<?php


namespace App\Core;


class App
{
    public static function start()
    {
        self::libs();
    }

    public static function libs()
    {
        $config = require_once 'config/app.php';
        foreach ($config['libs'] as $lib)
        {
            require_once "libs/" . $lib . ".php";
        }
    }

    public static function db()
    {

    }
}