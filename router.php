<?php

use App\Router;

$_router = new Router();

$router = $_router->getInstance(); //construct only

$router->get('/', function () {
    echo "Home";
});
$router->post('/about', function () {
    echo json_encode(["msg" => "123", "welcome" => "hello"]);
});

$router->run();
