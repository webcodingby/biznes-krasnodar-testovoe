<?php

namespace App\Core;

use App\Api\TaskControllers;
use JetBrains\PhpStorm\NoReturn;

class Router
{
    private static array $list = [];

    /*
     * Регистрация route страницы
     */
    public static function page($uri, $controller, $page, $method = 'index' ): void
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
    public static function post($uri, $controller, $method, $format = false): void
    {
        self::$list[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "action" => "POST",
            "format" => $format
        ];
    }

    public static function get($uri, $controller, $method): void
    {
        self::$list[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "action" => "GET",
        ];
    }

    public static function patch($uri, $controller, $method, $formdata = false): void
    {
        self::$list[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "action" => "PATCH",
            "formdata" => $formdata
        ];
    }

    public static function delete($uri, $controller, $method): void
    {
        self::$list[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "action" => "DELETE",
        ];
    }

    /*
     * Подключение нужной страницы к роуту
     */

    public static function pageData($data, $query): void
    {
        $param = explode('/', $query);
        if($param[0] !== 'api'){
            foreach (self::$list as $route)
            {
                if($route['uri'] === $query) {
                    $action = new $route['controller'];
                    $method = $route['method'];
                    $action->$method($data);
                    die();
                }
            }
        }
    }

    public static function userData($data, $query): void
    {
        foreach (self::$list as $route)
        {
            if($route['uri'] === $query) {
                $action = new $route['controller'];
                $method = $route['method'];
                $action->$method($data);
            }
        }
        die();
    }

    public static function redirect($uri): void
    {
        header('Location: ' . $uri);
    }

    /**
     * Включение роутинга
     * @throws \JsonException
     */
    public static function enable(): void
    {
        if(isset($_GET['q'])){
            $query = $_GET['q'];
            $param = explode('/', $query);
            if($param[0] === 'api'){
                self::param($param[2]);
                if($param[1] === 'postTask' && $_SERVER['REQUEST_METHOD'] === 'POST'){
                    TaskControllers::setTask($_POST);
                }
            }
        }else{
            $query = '/';
        }
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            self::userData($_POST,$query);
        }elseif($_SERVER['REQUEST_METHOD'] === "GET"){
            self::pageData($_GET, $query);
        }
    }

    /**
     * @throws \JsonException
     */
    public static function param($param): void
    {
        header('Content-type: json/application');
        if(isset($param)) {
            $id = $param;
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    TaskControllers::setTask($_POST);
                    break;
                case 'GET':
                    TaskControllers::getTask($id);
                    break;
                case 'PATCH':
                    $data = file_get_contents('php://input');
                    $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
                    TaskControllers::editTask($data, $id);
                    break;
                case 'DELETE':
                    TaskControllers::deleteTask($id);
                    break;
                default:
                    Page::error('404');
            }
        }
    }
}