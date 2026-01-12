<?php

namespace Core;


class Router{
    private $routes = [];

    public function register(string $method,string $route,string $action):self{
        $this->routes[$method][$route] = $action;
        return $this;
    }

    public function get($route, $action){
        return $this->register('get', $route, $action);
    }

    public function post( string $route, string $action){
        return $this->register('post', $route, $action);
    }


 
}