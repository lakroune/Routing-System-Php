<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;

class HomeController
{
    public function index()
    {
        return View::make('home/index', ['name' => 'John Doe']);
    }

    public function getAllUsers()
    {
        $userModel = new User();
        return View::make('view/home/users', ['users' => $userModel->getAll()]);
    }

    public function getUser($id)
    {
        $userModel = new User();
        return View::make('home/user', ['user' => $userModel->getOne($id)]);
    }

}
