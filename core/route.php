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

/*************  ✨ Windsurf Command ⭐  *************/
/**
 * Registers a GET route with the given route and action, but prepends
 * the prefix to the route.
 *
 * @param string $route The route path (e.g. '/users', '/products/:id', etc.)
 * @param string $action The action to be taken when the route is matched (e.g. a controller method).
 *
 * @return Router The current instance of the router.
 */
/*******  17d28195-6a6e-4094-bf02-1170cda23a57  *******/
            public function get(string $route, $action)
            {
                return $this->router->get($this->prefix . '/' . ltrim($route, '/'), $action);
            }

/*************  ✨ Windsurf Command ⭐  *************/
/**
 * Registers a POST route with the given route and action, but prepends
 * the prefix to the route.
 *
 * @param string $route The route path (e.g. '/users', '/products/:id', etc.)
 * @param string $action The action to be taken when the route is matched (e.g. a controller method).
 *
 * @return Router The current instance of the router.
 */
/*******  94e17170-5c22-4e04-ae29-cb998e2c3757  *******/
            public function post(string $route, $action)
            {
                return $this->router->post($this->prefix . '/' . ltrim($route, '/'), $action);
            }
        });

        return $this;
    }
}
