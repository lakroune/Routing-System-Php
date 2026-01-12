<?php

namespace Core;

use App\Exceptions\RouteNotFoundException;

class Router
{
    private static array $routes = [];
    private string $prefix = '';

    public function group(string $prefix): self
    {
        $router = clone $this;
        $router->prefix = rtrim($this->prefix . '/' . trim($prefix, '/'), '/');
        return $router;
    }

    private function register(string $method, string $route, $action): self
    {
        $method = strtolower($method);
        $fullRoute = rtrim($this->prefix . '/' . ltrim($route, '/'), '/') ?: '/';

        self::$routes[$method][$fullRoute] = $action;
        return $this;
    }

    public static function routes(): array
    {
        return self::$routes;
    }

    public function resolve(string $requestUri, string $method)
    {
        $method = strtolower($method);
        $uri = rtrim(parse_url($requestUri, PHP_URL_PATH), '/') ?: '/';

        if (!isset(self::$routes[$method])) {
            throw new RouteNotFoundException();
        }

        foreach (self::$routes[$method] as $routePattern => $action) {

            $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $routePattern);
            $pattern = '#^' . rtrim($pattern, '/') . '$#';

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // حذف full match
                return $this->dispatch($action, $matches);
            }
        }

        throw new RouteNotFoundException();
    }
    private function dispatch($action, array $params = [])
    {
        if (is_callable($action)) {
            return call_user_func_array($action, $params);
        }

        if (is_array($action)) {
            [$class, $method] = $action;

            if (!class_exists($class)) {
                throw new RouteNotFoundException();
            }

            $controller = new $class();

            if (!method_exists($controller, $method)) {
                throw new RouteNotFoundException();
            }

            return call_user_func_array([$controller, $method], $params);
        }

        throw new RouteNotFoundException();
    }
}
