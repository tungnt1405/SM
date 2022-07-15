<?php

namespace app\core;

// require_once  __DIR__ . '/../plugins/my-custom.php';

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
            echo $this->renderContent('Not Found');
            $this->response->httpStatusCode(404);
            die;
        }

        if (is_string($callback)) {
            echo $this->renderView($callback);
            die();
        }

        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }

        echo call_user_func($callback, $this->request);
    }

    public function renderView($view, $params = [])
    {
        $layout = $this->renderLayout();
        $content_view = $this->renderContentView($view, $params);

        return str_ireplace('{{ content }}', $content_view, $layout);
    }

    public function renderContent($view)
    {
        $layout = $this->renderLayout();
        return str_ireplace('{{ content }}', $view, $layout);
    }

    public function renderLayout()
    {
        $layout = Application::$app->controller->layout ?? 'main';
        ob_start();
        include_once __DIR__ . "/../Views/layouts/$layout.php";
        return ob_get_clean();
    }

    public function renderContentView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once __DIR__ . "/../Views/$view.php";
        return ob_get_clean();
    }
}
