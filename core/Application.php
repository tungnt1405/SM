<?php

namespace app\core;

class Application
{
    public static string $ROOT_PATH;
    public Routes $routes;
    public Request $request;
    public Response $response;
    public static Application $app;
    public function __construct($rootPath)
    {
        self::$ROOT_PATH = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->routes = new Routes($this->request, $this->response);
    }

    public function run(){
        $this->routes->resolve();
    }
}