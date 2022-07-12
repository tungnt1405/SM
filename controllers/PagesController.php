<?php

namespace app\controllers;

use app\core\Application;

class PagesController extends AppController
{
    public function index()
    {
        $params = array('name' => 'tung');
        return $this->render('welcome', $params);
    }
}