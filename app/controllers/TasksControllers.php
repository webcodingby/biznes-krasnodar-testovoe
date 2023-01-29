<?php


namespace App\Controllers;


use App\Core\DataBase;
use App\Core\Page;

class TasksControllers
{
    public function index()
    {
        $tasks = DataBase::getAll("SELECT * FROM `tasks` WHERE ");
        var_dump($_SESSION);
        Page::view('tasks', $tasks);
    }
}