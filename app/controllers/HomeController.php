<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;

class HomeController{
/**
 * Renders the index view with the name 'Ahmed'.
 *
 * @return string The rendered view.
 */
    public function index(){
        return View::make('home/index', ['name' => 'Ahmed']);
    }

/**
 * Renders the users view with all users.
 *
 * This method creates a new User instance, retrieves all users using the getAll() method,
 * and then renders the users view with the users data.
 *
 * @return string The rendered view.
 */
    public function getAllUsers(){
        $user = new User();
        $allUsers = $user->getAll();
        return View::make('home/users', ['users' => $allUsers]);
    }

/**
 * Renders the user view with a single user by ID.
 *
 * This method creates a new User instance, retrieves a single user by ID using the getOne() method,
 * and then renders the user view with the user data.
 *
 * @param int $id The ID of the user to retrieve.
 * @return string The rendered view.
 */
    public function getUser($id){
        $user = new User();
        $user = $user->getOne($id);
        return View::make('home/user', ['user' => $user]);
    }
}