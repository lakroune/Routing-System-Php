<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\HomeController;
use App\Exceptions\RouteNotFoundException;
use Core\Router;

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/users', [HomeController::class, 'getAllUsers']);
$router->get('/users/{id}', [HomeController::class, 'getUser']);

try {
    $basePath = '/Routing_System_Php'; // name of folder
    $requestUri = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
    $requestUri = $requestUri ?: '/'; // default page
    echo $router->resolve($requestUri, $_SERVER['REQUEST_METHOD']);
} catch (RouteNotFoundException $e) {
    echo $e->getMessage();
}
