<?php

use App\Api\TaskControllers;
use App\Api\UserControllers;
use App\Controllers\AdminControllers;
use App\Controllers\TasksControllers;
use App\Controllers\MainControllers;
use App\Core\Router;

/*
 * Страницы
 */
Router::page('/', MainControllers::class,'home');
Router::page('tasks', TasksControllers::class, 'tasks');
Router::page('admin', AdminControllers::class, 'home');

Router::post('auth', UserControllers::class, 'post', true);
Router::post('logout', UserControllers::class, 'logout');
Router::post("api/postTask", TaskControllers::class, "setTask", true);
Router::get("api/tasks", TaskControllers::class, "getTasks");
Router::get("api/task/id", TaskControllers::class, "getTask");
Router::patch("api/task/id", TaskControllers::class, "editTask", true);
Router::delete("api/task/id", TaskControllers::class, "deleteTask");

try {
    Router::enable();
} catch (JsonException $e) {
    echo $e->getMessage();
    die();
}
