<?php


namespace App\Controllers;


use App\Core\DataBase;
use App\Core\Page;
use JetBrains\PhpStorm\NoReturn;

class AdminControllers
{
    #[NoReturn] public function index(): void
    {
        $id = $_SESSION['id'];
        Page::view('admin', 'home', self::valuesInit($id));
        die();
    }

    public static function valuesInit($id): array
    {
        $itemsPerPage = 5;
        $offset = !empty($_GET['page'])?(($_GET['page']-1)*$itemsPerPage):0;
        $data['email'] = DataBase::getAll("SELECT email FROM users ORDER BY id DESC LIMIT $offset,$itemsPerPage");
        $data['data'] = DataBase::getAll("SELECT email, COUNT(tasks.user_id) 
                                                AS count FROM users 
                                                JOIN tasks 
                                                ON users.id = tasks.user_id 
                                                GROUP BY email ORDER BY count DESC;");
//        foreach ($data['email'] as $i => $iValue) {
//            $iValue[$i]['count'] = 0;
//        }
//        $data['result'] = array_merge($data['email'], $data['data']);
        $resultDB = DataBase::getAll("SELECT COUNT(*) AS cnt FROM `users` ");
        $enterRow = (int)$resultDB[0]['cnt'];
        $data['page'] = ceil($enterRow/$itemsPerPage);
        $data['user'] = DataBase::getRow("SELECT * FROM `users` WHERE `id`='$id'");
        return $data;
    }
}