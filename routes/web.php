<?php

/**
 * Tạo một space Application để quản lý các file trong project
 * gọi đến các đường dẫn trong router mục core
*/

use app\core\Application;
use \app\controllers\ContactController;
//TODO: call controller Application
$app = new Application(dirname(__DIR__));// khởi tạo class Applicationn và truyền đường dẫn thư mục gốc

//TODO: call Route for application
$app->routes->get("/", [\app\controllers\HomeController::class, "index"]);

//$app->routes->get("/contact", "contact");
$app->routes->get("/contact", [ContactController::class, "contact"]);
$app->routes->post("/contact", [ContactController::class, 'postContact']);

$app->routes->get("/login", [\app\controllers\AuthController::class, "login"]);
$app->routes->post("/login", [\app\controllers\AuthController::class, 'login']);
$app->routes->get("/register", [\app\controllers\AuthController::class, "register"]);
$app->routes->post("/register", [\app\controllers\AuthController::class, 'register']);

//TODO: call function run routes
$app->run();