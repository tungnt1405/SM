<?php

namespace app\controllers;

use app\core\Request;

class AuthController extends AppController
{
    public function login(){
        $this->setLayouts('auth');
        return $this->render('login');
    }

    public function register(Request $req){
        if($req->isPost()){
            echo $this->test();
            die();
        }
        $this->setLayouts('auth');
        return $this->render('register');
    }
}