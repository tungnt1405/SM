<?php

namespace app\controllers;

use app\core\Application;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginModel;
use app\models\UsersModel;

class AuthController extends AppController
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {
        $login = new LoginModel();
        if ($request->isPost()) {
            $login->loadData($request->getBody());
            if ($login->validate() && $login->login()) {
                $this->redirect('/');
            }
        }
        $this->setLayout('main');
        return $this->render('auth/login', [
            'model' => $login,
        ]);
    }

    public function register(Request $request)
    {
        $users =  new UsersModel();
        if ($request->isPost()) {
            $users->loadData($request->getBody());
            if ($users->validate() && $users->save()) {
                Application::$app->session->setFlash('success', 'User registered successfully.');
                $this->redirect('/');
            }
            // return $this->render('auth/register', [
            //     'model' => $users
            // ]);
        }
        $this->setLayout('main');
        return $this->render('auth/register', [
            'model' => $users
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $this->redirect('/');
    }

    public function profile()
    {
        return $this->render('auth/profile');
    }
}
