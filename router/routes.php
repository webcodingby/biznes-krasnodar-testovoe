<?php

use App\Core\Router;

/*
 * Страницы
 */
Router::page('/', 'App\Controllers\MainControllers','home');
Router::page('tasks', 'App\Controllers\TasksControllers', 'tasks');
Router::page('admin', 'App\Controllers\AdminControllers', 'home');

/*
 *  API User
*/
Router::post('auth', 'App\Api\UserControllers', 'post', true);
Router::post('logout', 'App\Controllers\Auth', 'logout');


Router::enable();
