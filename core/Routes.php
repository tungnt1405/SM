<?php

namespace app\core;
/**
 * @author TungNT1405<tung140520@gmail.com>
 * @package app\core\
 */
class Routes
{
    public Request $request;
    public Response $response;
    protected array $routes = array(); //

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes["get"][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes["post"][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
//            header("HTTP/1.1 404 NOT Found");
            $this->response->setStatusCode(404);
            echo $this->renderContentView("NOT FOUND");
            die;
        }

        //TODO: if callback returns string then find views
        if (is_string($callback)) {
//            echo $this->renderView($callback);
//            die;
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    public function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContentView($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_PATH . "/views/layouts/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_PATH . "/views/$view.php";
        return ob_get_clean();
    }
}