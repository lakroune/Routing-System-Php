<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;

class HomeController
{
    /**
     * This function renders the home page.
     * 
     * @return View The rendered view
     */
    public function index()
    {
        return View::make('home/index', ['message' => ' hello , i am home page']);
    }

    /**
     * Renders the users page.
     * 
     * This function renders the users page containing all users.
     * 
     * @return View The rendered view
     */
    public function getAllUsers()
    {
        $userModel = new User(0, '', '', '');
        return View::make('home/users', ['users' => $userModel->getAll()]);
    }

    /**
     * Renders the user page.
     * 
     * This function renders the user page containing a user with the given ID.
     * 
     * @param int $id The ID of the user
     * 
     * @return View The rendered view
     */
    public function getUser($id)
    {
        $userModel = new User(0, '', '', '');
        return View::make('home/user', ['user' => $userModel->getOne($id)]);
    }

}
