<?php


namespace App\Controllers;


use App\Core\DataBase;
use App\Core\Page;

class MainControllers
{
    public static function index()
    {
        Page::view('pages','home');
        die();
    }
}