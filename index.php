<?php
session_start();
use App\Core\App;


require_once __DIR__ . '/vendor/autoload.php';

App::start();

require_once __DIR__ . '/router/routes.php';
require_once __DIR__ . '/router/api.php';

