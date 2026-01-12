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
     public function resolve($requestUri, $method){
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$method][$route] ?? null;
        $params = [];
        
        if(!$action){
            foreach($this->routes[$method] as $key => $value){
                if(str_contains($key, '{')){
                    $res = explode('{', $key);
                    if(str_contains($route, $res[0])){
                        $currentRoute = explode($res[0],$route)[1];
                        $savedRoute = explode($res[0],$key)[1];

                        if(count(explode('/',$currentRoute)) == count(explode('/',$savedRoute))){
                            $result = explode('/',$currentRoute);
                            for($i=0; $i<count($result); $i++){
                                $params[] = $result[$i];
                            }
                            $action = $this->routes[$method][$key];
                        }
                    }
                }
            }
            if(count($params) == 0){
                throw new RouteNotFoundException();
            }
        }
            
        if(is_callable($action))
            return call_user_func_array($action, $params);

        if(is_array($action)){
            [$class, $method] = $action;

            if(class_exists($class)){
                $class = new $class();

                if(method_exists($class, $method)){
                    return call_user_func_array([$class, $method], $params);
                }
            }
        }

        throw new RouteNotFoundException();
    }
}
