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
        $itemsPerPage = 5;
        $offset = !empty($_GET['page'])?(($_GET['page']-1)*$itemsPerPage):0;
        $data = DataBase::getAll("SELECT * FROM `tasks` WHERE `user_id`='".$_SESSION['id']."' ORDER BY date DESC LIMIT $offset,$itemsPerPage");
        $resultDB = DataBase::getAll("SELECT COUNT(*) AS cnt FROM `tasks` WHERE `user_id`='".$_SESSION['id']."'");
        $enterRow = intval($resultDB[0]['cnt']);
        $user = DataBase::getRow("SELECT * FROM `users` WHERE `id`='".$_SESSION['id']."'");
        $result = ceil($enterRow/$itemsPerPage);
        Page::view('pages','tasks', [
            'data' => $data,
            'user' => $user,
            'pagesCount' => $result,
        ]);
    }
}