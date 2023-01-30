<?php

namespace App\Core;

use App\Api\UserControllers;
use App\Controllers;
use App\Controllers\AdminControllers;

class Router
{
    private static array $list = [];

    /*
     * Регистрация роута страницы
     */
    public static function page($uri, $controller, $page, $method = 'index' )
    {
        self::$list[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'page' => $page,
            'action' => false
        ];
    }

    /*
    * Api POST
    */
    public static function post($uri, $controller, $method, $formdata = false)
    {
        self::$list[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "action" => "POST",
            "formdata" => $formdata
        ];
    }

    /*
     * Подключение страницы нужной страницы к роуту
     */

    public static function pageController($data, $query)
    {
        $param = explode('/', $query);
        if($param[0] != 'api'){
            foreach (self::$list as $route)
            {
                if($route['uri'] == $query) {
                    $action = new $route['controller'];
                    $method = $route['method'];
                    $action->$method($data);
                    die();
                }
            }
            Page::error('404');
        }
    }

    public static function postController($data, $query)
    {
        foreach (self::$list as $route)
        {
            if($route['uri'] == $query) {
                $action = new $route['controller'];
                $method = $route['method'];
                $action->$method($data);
                die();
            }
        }
        Page::error('404');
    }

    public static function redirect($uri)
    {
        header('Location: ' . $uri);
    }

    public static function enable()
    {
        if(isset($_GET['q'])){
            $query = $_GET['q'];
        }else{
            $query = '/';
        }
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            self::postController($_POST,$query);
        }
        self::pageController($_GET, $query);
    }

    public static function logout($uri, $controller){
        self::$list[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "action" => "POST",
            "formdata" => $formdata
        ];
        session_destroy();
        self::redirect('/');
    }
}