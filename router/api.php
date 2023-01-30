<?php

use App\Core\Api;

/*
 * API Tasks
 */
Api::post("api/task", "App\Api\TaskControllers", "setTask", true);
Api::get("api/tasks", "App\Api\TaskControllers", "getTasks");
Api::get("api/task/id", "App\Api\TaskControllers", "getTask");
Api::patch("api/task/id", "App\Api\TaskControllers", "editTask", true);
Api::delete("api/task/id", "App\Api\TaskControllers", "deleteTask");


Api::router();