<?php


namespace App\Core;

class App
{
    public static function start(): void
    {
        self::libs();
        $db = new Database();
        $db::getDbh();
    }

    public static function libs(): void
    {
        $config = require 'config/app.php';
        foreach ($config['libs'] as $lib)
        {
            require_once "libs/" . $lib . ".php";
        }
    }

}