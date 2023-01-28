<?php


namespace App\Controllers;


use App\Core\DataBase;
use App\Core\Page;

class TasksControllers
{
    public function index()
    {
        $db = new DataBase();
        $tasks = $db->getAll('tasks');
        Page::view('tasks', $tasks);
    }
}