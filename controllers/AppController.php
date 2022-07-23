<?php

namespace app\controllers;

use app\core\Controller;

class AppController extends Controller
{
    public function __construct()
    {
        $this->setJson();
    }
}
