<?php

namespace app\core;

// require_once  __DIR__ . '/../plugins/my-custom.php';

use app\core\exception\NotFoundException;

class Router
{
    public array $routes = array();
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        return $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        return $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
//            echo $this->renderContent('Not Found');
            $this->response->httpStatusCode(404);
            throw new NotFoundException();
//            die;
        }

        if (is_string($callback)) {
//            echo $this->renderView($callback);
//            die();
            return Application::$app->view->renderView($callback);
        }

        if (is_array($callback)) {
            /** @var \app\core\Controller $controller */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddleware() as $middleware) {
                $middleware->execute();
            }
        }

        echo call_user_func($callback, $this->request, $this->response);
    }
}
