

 <?php

    require_once __DIR__ . '/vendor/autoload.php';

    use App\Exceptions\RouteNotFoundException;
    use App\Controllers\HomeController;

    $router = new Core\Router;
 