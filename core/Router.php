<?php

namespace Core;

use App\Exceptions\RouteNotFoundException;

class Router
{
    private $routes = [];

   
    /**
     * Registers a route with the given HTTP method, route path, and action.
     *
     * @param string $method The HTTP method to register the route for.
     * @param string $route The route path to register.
     * @param callable|string|array $action The action to call when the route is matched.
     * @return self
     */
    public function register(  $method,   $route,  $action): self
    {
        $this->routes[$method][$route] = $action;
        return $this;
    }

    /**
     * Registers a GET route with the given route and action.
     *
     * @param string $route The route path to register.
     * @param string $action The action to call when the route is matched.
     * @return self
     */
    public function get($route, $action)
    {
        return $this->register('get', $route, $action);
    }

     
    /**
     * Registers a POST route with the given route and action.
     *
     * @param string $route The route path to register.
     * @param callable|string|array $action The action to call when the route is matched.
     * @return self
     */
    public function post( $route,  $action)
    {
        return $this->register('post', $route, $action);
    }

    /**
     * Registers a group of routes with the given prefix.
     *
     * The given callback will be called with a new instance of the Router
     * class, which has get and post methods that will register routes with the
     * given prefix.
     *
     * @param string $prefix The prefix to register the routes with.
     * @param callable $callback The callback to call with the new Router instance.
     * @return self
     */
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
    /**
     * Resolves the given route to an action.
     *
     * @param string $requestUri The request URI to resolve.
     * @param string $method The HTTP method to resolve the route for.
     * @return mixed The result of calling the resolved action.
     * @throws RouteNotFoundException If the route cannot be resolved.
     */
    public function resolve($requestUri, $method)
    {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$method][$route] ?? null;
        $params = [];

        if (!$action) {
            foreach ($this->routes[$method] as $key => $value) {
                if (str_contains($key, '{')) {
                    $res = explode('{', $key);
                    if (str_contains($route, $res[0])) {
                        $currentRoute = explode($res[0], $route)[1];
                        $savedRoute = explode($res[0], $key)[1];

                        if (count(explode('/', $currentRoute)) == count(explode('/', $savedRoute))) {
                            $result = explode('/', $currentRoute);
                            for ($i = 0; $i < count($result); $i++) {
                                $params[] = $result[$i];
                            }
                            $action = $this->routes[$method][$key];
                        }
                    }
                }
            }
            if (count($params) == 0) {
                throw new RouteNotFoundException();
            }
        }

        if (is_callable($action))
            return call_user_func_array($action, $params);

        if (is_array($action)) {
            [$class, $method] = $action;

            if (class_exists($class)) {
                $class = new $class();

                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], $params);
                }
            }
        }

        throw new RouteNotFoundException();
    }
}
