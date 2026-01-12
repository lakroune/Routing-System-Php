<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;

class HomeController
{
    public function index()
    {
        return View::make('home/index', ['message' => ' hello , i am home page']);
    }

    public function getAllUsers()
    {
        $userModel = new User(0, '', '', '');
        return View::make('home/users', ['users' => $userModel->getAll()]);
    }

    public function getUser($id)
    {
        $userModel = new User(0, '', '', '');
        return View::make('home/user', ['user' => $userModel->getOne($id)]);
    }

}
