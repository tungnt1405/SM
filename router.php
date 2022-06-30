<?php

use App\Handler\Handler;
use App\Router;

$_router = new Router();

$router = $_router->getInstance(); //construct only

$router->get('/', function () {
    echo "Home";
});
$router->get('/about', function (array $params = []) {
    if (!empty($params)) {
        dd($params);
    }
});
$router->get('/handler', Handler::class . "::exec");
$router->post('/handler', function ($params) {
    dd($params);
    // echo json_encode(["msg" => "handler", "welcome" => "param:" . $params]);
});

$router->addNotFoundHandler(function () {
    $title = "404 Not Found";
    require_once __DIR__ . "/Views/Error/404.phtml";
});
$router->run();
