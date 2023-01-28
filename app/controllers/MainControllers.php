<?php


namespace App\Controllers;


use App\Core\Page;

class MainControllers
{
    public static function index()
    {
        Page::view('home');
        die();
    }
}