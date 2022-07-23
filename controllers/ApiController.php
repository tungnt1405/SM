<?php

namespace app\controllers;

use app\core\Application;
use app\models\SmModel;

class ApiController extends AppController
{
    public function get()
    {
        $sm = new SmModel();
        $arr = $sm->select('users');
        return json_encode($arr);
    }
    public function post()
    {
    }
}
