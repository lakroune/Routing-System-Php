<?php
require_once __DIR__ . '/vendor/autoload.php';
use Core\Router;
use App\Exceptions\RouteNotFoundException;

$router = new Router();

$router
    ->group('/admin')
    ->get('/dashboard', fn() => 'Bienvenue sur le Dashboard!')
    ->get('/users/{id}', fn($id) => "Utilisateur avec ID: $id");

$router
    ->group('/api')
    ->post('/login', fn() => 'Connexion réussie');
 
   
try {
    echo $router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
} catch (RouteNotFoundException $e) {
    $e->getMessage();
}

