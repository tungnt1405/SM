<?php

namespace app\core;

require_once  __DIR__ . '/../plugins/my-custom.php';

class Application
{
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public function __construct()
    {
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run(){
        $this->router->resolve();
    }

}