<?php

namespace Core;

use App\Exceptions\RouteNotFoundException;

class Router
{
    private static array $routes = [];
    private string $prefix = '';



    /**
     * Returns a new instance of the router, with the given prefix prepended to the existing prefix.
     * This allows you to group routes together, with a common prefix.
     *
     * @param string $prefix The prefix to add to the existing prefix.
     *
     * @return self A new instance of the router, with the updated prefix.
     */
    public function group(string $prefix): self
    {
        $router = clone $this;
        $router->prefix = rtrim($this->prefix . '/' . trim($prefix, '/'), '/');
        return $router;
    }

    /**
     * Registers a GET route.
     *
     * @param string $route The route to register for GET requests
     * @param mixed $action The action to perform when the route is matched
     *
     * @return self
     */
    public function get(string $route, $action): self
    {
        return $this->register('get', $route, $action);
    }

    /**
     * Registers a POST route.
     *
     * @param string $route The route to register for POST requests
     * @param mixed $action The action to perform when the route is matched
     *
     * @return self
     */
    public function post(string $route, $action): self
    {
        return $this->register('post', $route, $action);
    }


    /**
     * Registers a route.
     *
     * @param string $method The HTTP method for the route (e.g. "get", "post", etc.)
     * @param string $route The route to register (e.g. "/users", etc.)
     * @param mixed $action The action to perform when the route is matched (e.g. a closure, a controller method, etc.)
     *
     * @return self
     */
    private function register(string $method, string $route, $action): self
    {
        $method = strtolower($method);
        $fullRoute = rtrim($this->prefix . '/' . ltrim($route, '/'), '/') ?: '/';
        self::$routes[$method][$fullRoute] = $action;
        return $this;
    }

    /**
     * Resolves a route from the given request URI and HTTP method.
     *
     * This method will iterate through all registered routes for the given HTTP method,
     * and attempt to match the route pattern against the given request URI.
     * If a match is found, the associated action will be executed with any
     * matched parameters passed to it.
     *
     * If no matching route is found, a RouteNotFoundException will be thrown.
     *
     * @param string $requestUri The request URI to resolve
     * @param string $method The HTTP method for the request
     *
     * @return mixed The result of executing the associated action
     *
     * @throws RouteNotFoundException If no matching route is found
     */
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
                array_shift($matches);
                return $this->dispatch($action, $matches);
            }
        }

        throw new RouteNotFoundException();
    }

    /**
     * Dispatches the given action with the given parameters.
     *
     * This method will check if the action is a callable, and if so, it will
     * call the action with the given parameters using call_user_func_array.
     * If the action is an array, it will assume that the first element is the
     * class name of a controller, and the second element is the method name
     * of the controller action to call. It will then instantiate the controller,
     * check if the method exists, and call the method with the given parameters
     * using call_user_func_array.
     *
     * If the action is not a callable or an array, a RouteNotFoundException will
     * be thrown.
     *
     * @param mixed $action The action to dispatch
     * @param array $params The parameters to pass to the action
     *
     * @return mixed The result of dispatching the action
     *
     * @throws RouteNotFoundException If the action is not a callable or an array
     */
    private function dispatch($action, array $params = [])
    {
        if (is_callable($action)) {
            return call_user_func_array($action, $params);
        }

        if (is_array($action)) {
            [$class, $method] = $action;
            if (!class_exists($class)) throw new RouteNotFoundException();
            $controller = new $class();
            if (!method_exists($controller, $method)) throw new RouteNotFoundException();
            return call_user_func_array([$controller, $method], $params);
        }

        throw new RouteNotFoundException();
    }
}
