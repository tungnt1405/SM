<?php

namespace app\controllers;

use app\core\Request;

class AuthController extends AppController
{
    public function login()
    {
        return $this->render('auth/login');
    }

    public function register(Request $request)
    {
        if($request->isPost()){
            return "method post";
        }

        return $this->render('auth/register');
    }
}