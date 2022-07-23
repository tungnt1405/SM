<?php

namespace app\core;

// require_once  __DIR__ . "/../plugins/my-custom.php";

use app\core\middlewares\BaseMiddleWare;

class Controller
{
    public string $layout = 'main';
    public string $action = '';
    /*
     * @var app\core\middlewares\BaseMiddleWare[]
    */
    protected array $middleware = array();
    public function render($view, $params = array())
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function redirect($url)
    {
        Application::$app->response->redirect($url);
    }

    public function registerMiddleware(BaseMiddleWare $middleware)
    {
        $this->middleware[] = $middleware;
    }

    /**
     * @return array
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }

    public function setJson()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Headers: X-Requested-With");
    }
}
