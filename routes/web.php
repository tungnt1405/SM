<?php

use app\core\Application;
use \app\controllers\AppController;
//TODO: call controller Application
$app = new Application(dirname(__DIR__));

//TODO: call Route for application
$app->routes->get("/", "home");

$app->routes->get("/contact", "contact");
//$app->routes->get("/contact", [AppController::class, "contact"]);

$app->routes->post("/contact", [AppController::class, 'postContact']);

//TODO: call function run routes
$app->run();