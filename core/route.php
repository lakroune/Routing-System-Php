<?php

namespace Core;


class Router
{
    private $routes = [];

    public function register(string $method, string $route, string $action): self
    {
        $this->routes[$method][$route] = $action;
        return $this;
    }

    public function get($route, $action)
    {
        return $this->register('get', $route, $action);
    }

    public function post(string $route, string $action)
    {
        return $this->register('post', $route, $action);
    }

    public function group($prefix, $callback)
    {
        $callback(new class($this, $prefix) {
            private Router $router;
            private string $prefix;

            public function __construct(Router $router, string $prefix)
            {
                $this->router = $router;
                $this->prefix = rtrim($prefix, '/');
            }

            public function get(string $route, $action)
            {
                return $this->router->get($this->prefix . '/' . ltrim($route, '/'), $action);
            }

            public function post(string $route, $action)
            {
                return $this->router->post($this->prefix . '/' . ltrim($route, '/'), $action);
            }
        });

        return $this;
    }
}
