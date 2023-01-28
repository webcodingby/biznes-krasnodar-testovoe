<?php

use App\Core\Router;

/*
 * Страницы
 * Страницы
 */
Router::page('/', 'App\Controllers\MainControllers','home');
Router::page('/tasks', 'App\Controllers\TasksControllers', 'tasks');
Router::page('/admin', 'App\Controllers\AdminControllers', 'home');

/*
 *  API
*/
Router::post('/api/auth', 'App\Api\UserControllers', 'post', true);
Router::post('/api/validate', 'App\Controllers\ValidateInput', 'validateEmail', true);

Router::enable();
