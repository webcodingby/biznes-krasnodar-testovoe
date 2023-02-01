<?php


namespace App\Controllers;


use App\Core\DataBase;
use App\Core\Page;

class AdminControllers
{
    public function index()
    {
        $itemsPerPage = 5;
        $offset = !empty($_GET['page'])?(($_GET['page']-1)*$itemsPerPage):0;
        $data['email'] = DataBase::getAll("SELECT email FROM users ORDER BY id DESC LIMIT $offset,$itemsPerPage");
        $data['data'] = DataBase::getAll("SELECT email, COUNT(tasks.user_id) 
                                                AS count FROM users 
                                                JOIN tasks 
                                                ON users.id = tasks.user_id 
                                                GROUP BY email;");
        $data['result'] = $data['data'] + $data['email'];
        $resultDB = DataBase::getAll("SELECT COUNT(*) AS cnt FROM `users` ");
        $enterRow = intval($resultDB[0]['cnt']);
        $data['page'] = ceil($enterRow/$itemsPerPage);
        $data['user'] = DataBase::getRow("SELECT * FROM `users` WHERE `id`='".$_SESSION['id']."'");

        Page::view('admin', 'home', $data);
        die();
    }
}