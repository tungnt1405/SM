<?php

namespace app\core;

// require_once  __DIR__ . '/../plugins/my-custom.php';

use app\core\Session\Session;

class Application
{
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public static string $root_path;
    public Controller $controller;
    public Database $db;
    public Session $session;
    public function __construct($root_path, array $config)
    {
        self::$app = $this;
        self::$root_path = $root_path;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();

        $this->db = new Database($config['db']);
    }

    public function run(){
        $this->router->resolve();
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