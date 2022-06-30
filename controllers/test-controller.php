<?php
require_once("app-controller.php");
// require_once('models/user.php');
class TestController extends AppController
{
    public function __construct()
    {
        $this->folder = "test";
    }

    public function index()
    {
        $this->render('index');
    }

    public function notFound()
    {
    }
}
