<?php

namespace app\controllers;
use app\controllers\AppController;
use app\core\Request;

class ContactController extends AppController
{
    public function contact(Request $req){
        $body = $req->getBody();
        return $this->render('contact');
    }

    public function postContact(){
        return "HiHi";
    }
}