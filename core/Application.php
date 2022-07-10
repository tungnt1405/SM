<?php

namespace app\core;
/**
 * Khởi tạo các file sẽ được dùng và quản lý
*/
class Application
{
    public static string $ROOT_PATH;
    public Routes $routes;
    public Request $request;
    public Response $response;
    public static Application $app;
    public Controller $controller;
    public function __construct($rootPath)
    {
        self::$ROOT_PATH = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->routes = new Routes($this->request, $this->response);// khởi tạo class Router và truyền req và res
    }

    /**
     * chạy đường dẫn đã truyền ở route/web
    */
    public function run(){
        $this->routes->resolve();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}