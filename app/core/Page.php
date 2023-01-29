<?php


namespace App\Core;


class Page
{

    public static function part($partName, $title = '')
    {
        $title = ($title) ? $title : '';
        require_once "views/components/" . $partName . ".php";
    }

    public static function view($pageName, $data = '')
    {
        $data = ($data) ? $data : '';
        require_once "views/pages/" . $pageName . ".php";
    }

    public static function admin($pageName,$data = '')
    {
        $data = ($data) ? $data : '';
        require_once "views/admin/" . $pageName . ".php";
    }

    public static function error($error)
    {
        require_once "views/errors/" . $error . ".php";
    }

}