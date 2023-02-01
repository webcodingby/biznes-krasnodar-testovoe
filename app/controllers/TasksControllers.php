<?php


namespace App\Controllers;


use App\Core\DataBase;
use App\Core\DB;
use App\Core\Page;
use App\Models\Task;
use JetBrains\PhpStorm\ArrayShape;

class TasksControllers
{
    public function index(): void
    {
        $id = $_SESSION['id'];
        Page::view('pages','tasks', self::valuesInit($id));
    }

    #[ArrayShape(['data' => "array", 'user' => "mixed", 'pagesCount' => "float"])]
    public static function valuesInit($id): array
    {
        $itemsPerPage = 5;
        $offset = !empty($_GET['page'])?(($_GET['page']-1)*$itemsPerPage):0;
        $tasks = DataBase::getRequest('tasks', "WHERE user_id=$id","ORDER BY date","LIMIT $offset,$itemsPerPage");
        $tasksPage = DataBase::getTasksCount("tasks", "WHERE user_id=$id");
        $enterRow = (int)$tasksPage[0]['count'];
        $user = DataBase::getRequest("users", "WHERE id=$id");
        $result = ceil($enterRow/$itemsPerPage);
        return [
            'data' => $tasks,
            'user' => $user[0],
            'pagesCount' => $result,
        ];
    }
}