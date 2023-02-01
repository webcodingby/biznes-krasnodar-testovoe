<?php


namespace App\Core;



class Page
{
    public static function part($partName, $title = '', $user = '', $uri = ''): void
    {

        $uri = (isset($_GET['q'])) ? $_GET['q'] : '';
        $title = ($title) ?: '';
        $user = ($user) ? DataBase::getRow("SELECT * FROM `users` WHERE `id`='".$_SESSION['id']."'") : '';
        require_once "views/components/" . $partName . ".php";
    }

    public static function view($pageFolder, $pageName, $data = ''): void
    {
        $data = ($data) ?: '';
        require_once "views/" .$pageFolder. "/" . $pageName . ".php";
    }

    public static function error($error): void
    {
        require_once "views/errors/" . $error . ".php";
    }

}