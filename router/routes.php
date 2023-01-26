<?php

use App\Core\Router;

Router::page('/home', 'home', 'Авторизация');
Router::page('/tasks', 'tasks', 'Задачи');

Router::enable();