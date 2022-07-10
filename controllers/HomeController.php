<?php

namespace app\controllers;

class HomeController extends AppController
{
    public function index(){
        $params = array(
            'name'=>'tung140520'
        );
        return $this->render('home',$params);
    }
}