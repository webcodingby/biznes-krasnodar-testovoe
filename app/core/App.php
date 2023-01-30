<?php


namespace App\Core;

use App\Core\DB;
use App\Models\Task;

class App
{
    public static function start()
    {
        self::libs();
        $db = new Database();
        $db->getDbh();
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