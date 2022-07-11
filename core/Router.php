<?php

namespace app\core;

class Router
{
    public array $routes = array();
    public Request $request;
    public Response $response;
    public function __construct(Request $request, Response $response)
    {
        $this->request  = $request;
        $this->response = $response;
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
            $this->response->httpStatusCode(404);
            die;
        }

        echo call_user_func($callback);
    }
}