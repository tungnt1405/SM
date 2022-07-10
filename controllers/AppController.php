<?php

namespace app\controllers;


use app\core\Controller;

class AppController extends Controller
{
    public function test(){
        return $_POST['_method'];
    }
}