<?php

namespace App;

class Router
{
    private array $hanlders;
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';

    public static $router_instance = null;

    function getInstance()
    {
        if (self::$router_instance) {
            return self::$router_instance;
        }

        new Router();
        $router_instance = $this;
        return $router_instance;
    }

    /*
        handler method get
    */
    public function get(string $path, $handler): void
    {
        $this->addHandler(self::METHOD_GET, $path, $handler);
    }


    /*
        handler method get
    */
    public function post(string $path, $handler): void
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }


    /*
        add handler method
    */
    private function addHandler(string $method, string $path, $handler): void
    {
        $this->hanlders[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }


    /*
        run handler method
    */
    public function run()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        foreach ($this->hanlders as $handler) {
            if ($handler['path'] === $requestPath && $method === $handler['method']) {
                $callback = $handler['handler'];
            }
        }

        call_user_func_array($callback, [
            array_merge($GLOBALS)
        ]);
    }
}
