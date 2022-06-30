<?php
require_once("app-controller.php");
// require_once('models/user.php');
class PagesController extends AppController
{
    public function __construct()
    {
        $this->folder = "pages";
    }

    public function index()
    {
        $this->render('index');
    }

    public function notFound()
    {
    }
}
