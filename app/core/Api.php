<?php

namespace App\Core;

use App\Api\TaskControllers;
use App\Api\UserControllers;
use App\Controllers;
use App\Controllers\AdminControllers;

class Api
{
    private static array $list = [];
    /*
     * Api POST
     */
    public static function router(){
        header('Content-type: json/aplplication');
        $query = $_GET['q'];
        $param = explode('/', $query);
        if($param[0] === 'api'){
            if(isset($param[2])){
                $id = $param[2];
                switch ($_SERVER['REQUEST_METHOD']) {
                    case 'POST':
                        TaskControllers::setTask($_POST);
                        break;
                    case 'GET':
                        TaskControllers::getTask($id);
                        break;
                    case 'PATCH':
                        TaskControllers::editTask($_POST, $id);
                        break;
                    case 'DELETE':
                        TaskControllers::deleteTask($id);
                        break;
                }
            }
        }
        if($param[1] === 'tasks' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            TaskControllers::getTasks($_GET);
        }
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


    public static function get($uri, $controller, $method)
    {
        self::$list[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "action" => "GET",
        ];
    }

    public static function patch($uri, $controller, $method, $formdata = false)
    {
        self::$list[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "action" => "PATCH",
            "formdata" => $formdata
        ];
    }

    public static function delete($uri, $controller, $method)
    {
        self::$list[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "action" => "DELETE",
        ];
    }

    /*
     * Подключение страницы нужной страницы к роуту
     */

    public static function postController($data, $query, $id = null)
    {
        foreach (self::$list as $route)
        {
            if($route['uri'] == $query) {
                $action = new $route['controller'];
                $method = $route['method'];
                $action->$method($data, $id);
                die();
            }
        }
        Page::error('404');
    }

    public static function editController($data, $query, $id)
    {
        foreach (self::$list as $route)
        {
            if($route['uri'] == $query) {
                $action = new $route['controller'];
                $method = $route['method'];
                $action->$method($data, $id);
                die();
            }
        }
    }

    public static function deleteController($id, $query)
    {
        foreach (self::$list as $route)
        {
            if($route['uri'] == $query) {
                $action = new $route['controller'];
                $method = $route['method'];
                $action->$method($id);
                die();
            }
        }
    }

    public static function redirect($uri)
    {
        header('Location: ' . $uri);
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