<?php

namespace app\core;

class Router
{
    public array $routes = array();
    public Request $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        return $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false){
            echo "NOT FOUND";
            die;
        }

        echo call_user_func($callback);
    }
}