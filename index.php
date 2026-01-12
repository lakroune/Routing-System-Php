<?php

/**
 * Autoload all classes using Composer
 */
require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\HomeController;
use App\Exceptions\RouteNotFoundException;
use Core\Router;

/**
 * Initialize the Router
 *
 * This instance is responsible for registering routes and resolving
 * incoming HTTP requests to the appropriate controller methods.
 */
$router = new Router();

/**
 * Route Definitions
 * 
 * Define the application routes. Each route maps an HTTP method and URL
 * pattern to a specific controller and method.
 */

/**
 * GET /
 * 
 * Main route for the homepage.
 * Maps to HomeController::index
 */
$router->get('/', [HomeController::class, 'index']);

/**
 * GET /users
 * 
 * Route to retrieve all users.
 * Maps to HomeController::getAllUsers
 */
$router->get('/users', [HomeController::class, 'getAllUsers']);

/**
 * GET /users/{id}
 * 
 * Route to retrieve a single user by ID.
 * The {id} is a dynamic parameter passed to HomeController::getUser
 */
$router->get('/users/{id}', [HomeController::class, 'getUser']);

try {
    /**
     * Request Handling
     * 
     * 
     *Retrieve the current request URI and remove the base path if the
     * application is located in a subfolder. If no URI is provided, default
     * to the root "/".
     */

    $basePath = '/Routing_System_Php'; // Folder name of the application
    $requestUri = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
    $requestUri = $requestUri ?: '/'; // Default route

    /**
     * Resolve the route using the Router.
     * The Router will match the request URI and HTTP method to the
     * registered routes and call the corresponding controller method.
     */
    echo $router->resolve($requestUri, $_SERVER['REQUEST_METHOD']);
} catch (RouteNotFoundException $e) {
    /**
     * Error Handling
     * 
     * If the requested route does not exist, a RouteNotFoundException is thrown.
     * Display the exception message as a response.
     */
    echo $e->getMessage();
}
