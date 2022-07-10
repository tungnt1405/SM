<?php

namespace app\core;
/**
 * file điểu khiển controllers
 * file cha cho thư mục controllers
*/

use app\core\Application;

class Controller
{
    public string $layout = 'main';

    public function render($view, $params = array())
    {
        return Application::$app->routes->renderView($view, $params);
    }

    public function setLayouts($layouts)
    {
        $this->layout = $layouts;
    }
}