<?php


namespace App\Controllers;


use App\Core\DataBase;
use App\Core\Page;
use JetBrains\PhpStorm\NoReturn;

class MainControllers
{
    public static function index(): void
    {
        Page::view('pages','home');
    }
}