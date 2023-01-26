<?php

namespace App\Core;

class Router
{
    private static $list = [];

    public static function page($uri, $pageName)
    {
        self::$list[] = [
            "uri" => $uri,
            "page" => $pageName,
        ];
    }

    public static function enable()
    {
        $query = $_GET['q'];

        foreach (self::$list as $route)
        {
            if($route['uri'] === '/' . $query)
            {
                require_once "views/pages/" . $route['page'] . ".php";
                die();
            }
        }

        self::pageNotFound();
    }

    private static function pageNotFound()
    {
        require_once "views/errors/404.php";
        die();
    }
}