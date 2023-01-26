<?php

use App\Core\Router;

Router::page('/home', 'home');
Router::page('/tasks', 'tasks');

Router::enable();