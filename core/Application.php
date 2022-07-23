<?php

namespace app\core;

// require_once  __DIR__ . '/../plugins/my-custom.php';

use app\core\db\Database;
use app\core\db\DbModel;
use app\core\Session\Session;
use app\models\UsersModel;

class Application
{
    public string $layout = 'main';
    public Router $router;
    public string $userClass;
    public Request $request;
    public Response $response;
    public static Application $app;
    public static string $root_path;
    public ?Controller $controller = null;
    public Database $db;
    public Session $session;
    public ?UsersModel $user;
    public Views $view;
    public function __construct($root_path, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$app = $this;
        self::$root_path = $root_path;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->view = new Views();

        $this->db = new Database($config['db']);

        $primary_key_value = $this->session->get('user');
        if ($primary_key_value) {
            $primary_key  = $this->userClass::getPrimaryKey();
            $this->user = $this->userClass::findOne([$primary_key => $primary_key_value]);
        } else {
            $this->user = null;
        }
    }

    public function run()
    {
        try {
           echo $this->router->resolve();
        }catch (\Exception $e) {
            $this->response->httpStatusCode($e->getCode());
            echo $this->view->renderView('_error',[
                'exception' => $e,
            ]);
        }
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(UsersModel $user)
    {
        $this->user = $user;
        $primary_key = $user->getPrimaryKey();
        $primary_key_value = $user->{$primary_key};
        $this->session->set('user', $primary_key_value);
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public function isGuest()
    {
        return !self::$app->user;
    }
}
