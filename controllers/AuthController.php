<?php

namespace app\controllers;

use app\core\Request;
use app\models\UsersModel;

class AuthController extends AppController
{
    public function login()
    {
        return $this->render('auth/login');
    }

    public function register(Request $request)
    {
        $users =  new UsersModel();
        if ($request->isPost()) {
            $users->loadData($request->getBody());
            if ($users->validate() && $users->register()) {
                return 'Success';
            }
            return $this->render('auth/register', [
                'model' => $users
            ]);
        }
        $this->setLayout('main');
        return $this->render('auth/register', [
            'model' => $users
        ]);
    }
}
