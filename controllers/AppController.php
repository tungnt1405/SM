<?php

namespace app\controllers;

use app\core\Application;

class AppController
{
    public function contact(){
        echo Application::$app->routes->renderView('contact');
    }

    public function postContact(){
        echo "HiHi";
    }

}