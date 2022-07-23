<?php

namespace app\core;

class Views
{
    public string $title = '';

    public function renderView($view, $params = [])
    {
        $content_view = $this->renderContentView($view, $params);
        $layout = $this->renderLayout();

        return str_ireplace('{{ content }}', $content_view, $layout);

    }

    public function renderContent($view)
    {
        $layout = $this->renderLayout();
        return str_ireplace('{{ content }}', $view, $layout);
    }

    public function renderLayout()
    {
        $layout = Application::$app->layout;
        if (Application::$app->controller) {
            $layout = Application::$app->controller->layout;
        }
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