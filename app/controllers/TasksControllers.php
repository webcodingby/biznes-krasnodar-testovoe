<?php


namespace App\Controllers;


use App\Core\DataBase;
use App\Core\DB;
use App\Core\Page;
use App\Models\Task;

class TasksControllers
{
    public function index()
    {
        $id = $_SESSION['id'];
        Page::view('pages','tasks', self::valuesInit($id));
    }

    public static function valuesInit($id){
        $itemsPerPage = 5;
        $offset = !empty($_GET['page'])?(($_GET['page']-1)*$itemsPerPage):0;
        $tasks = DataBase::getRequest('tasks', "WHERE user_id=$id","ORDER BY date","LIMIT $offset,$itemsPerPage");
        $tasksPage = DataBase::getTasksCount("tasks", "WHERE user_id=$id");
        $enterRow = (int)$tasksPage[0]['count'];
        $user = DataBase::getRequest("users", "WHERE id=$id");
        $result = ceil($enterRow/$itemsPerPage);
        $data = [
            'data' => $tasks,
            'user' => $user[0],
            'pagesCount' => $result,
        ];
        return $data;
    }
}