<?php

namespace App\Core;

class Router
{
    private static $list = [];
    public static $title;

    /*
     * Регистрация роута страницы
     */
    public static function page($uri, $pageName, $title)
    {
        self::$list[] = [
            "uri" => $uri,
            "page" => $pageName,
            "title" => $title,
        ];
    }

    /*
     * Подключение страницы нужной страницы к роуту
     */

    public static function enable()
    {
        $query = $_GET['q'];

        foreach (self::$list as $route)
        {
            if($route['uri'] === '/' . $query)
            {
                self::$title = $route['title'];
                Page::view('pages',$route['page']);
            }
        }

        self::pageNotFound();
    }

    private static function pageNotFound()
    {
        Page::view('errors','404');
    }
}