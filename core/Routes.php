<?php

use app\core\Application;

/**
 * điểu hướng phần Router
 */


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
        // TODO: return method get
        $this->routes["get"][$path] = $callback;
    }

    public function post($path, $callback)
    {
        // TODO: return method post
        $this->routes["post"][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false; // trả về một object gồm method và path

        if (!$callback) {
//            header("HTTP/1.1 404 NOT Found");
            $this->response->setStatusCode(404);
//            echo $this->renderContentView("NOT FOUND");
//            die;
            return $this->renderContentView("NOT FOUND");
        }

        //TODO: if callback returns string then find views
        if (is_string($callback)) {
//            echo $this->renderView($callback);
//            die;
            return $this->renderView($callback);
        }

        //TODO:: if callback return array
        if (is_array($callback)) {
//            $callback[0] = new $callback[0]();
            Application::$app->controller = new $callback[0]();// gán biến controler bên appication là 1 object khởi tạo từ mảng
            $callback[0] = Application::$app->controller;// gán cho giá trị key = 0 là biến controler bên appication
        }
        echo call_user_func($callback, $this->request);// hiển thị dữ liệu lấy được từ view hoặc biến truyền vào ra màn hình
    }


    /**
     * lấy content từ layout và file view
     * sau đó thay thế nội dung view vào text {{content}}
     */
    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * lấy content từ layout
     * sau đó thay thế nội dung text truyền vào cho text {{content}}
     */
    public function renderContentView($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * lấy content từ layout và file view
     */
    public function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_PATH . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    /**
     * lấy content từ file view
     */
    protected function renderOnlyView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_PATH . "/views/$view.php";
        return ob_get_clean();
    }
}