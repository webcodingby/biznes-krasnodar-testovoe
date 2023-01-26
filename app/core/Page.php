<?php


namespace App\Core;


class Page
{
    public static function part($partName)
    {
        require_once "views/components/" . $partName . ".php";
    }

    public static function view($part, $pageName)
    {
        require_once "views/". $part . "/" . $pageName . ".php";
        die();
    }
}