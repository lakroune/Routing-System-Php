<?php

require_once __DIR__.'/vendor/autoload.php';
use App\Exceptions\RouteNotFoundException;

$router = new Core\Router;

$router
->get('/', [App\Controllers\HomeController::class, 'index'])
->group('/user', function($group){
    $group->get('/list', [App\Controllers\HomeController::class, 'getAllUsers']);
    $group->get('/{id}', [App\Controllers\HomeController::class, 'getUser']);
});

try{
    echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
}catch(RouteNotFoundException $e){
    echo $e->getMessage();
}