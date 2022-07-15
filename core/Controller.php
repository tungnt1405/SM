<?php

namespace app\core;

// require_once  __DIR__ . "/../plugins/my-custom.php";

class Controller
{
    public string $layout = 'main';
    public function render($view, $params = array())
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}
