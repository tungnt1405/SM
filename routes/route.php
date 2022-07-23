<?php

$app->router->get('/', [\app\controllers\PagesController::class, "index"]);
$app->router->get('/login', [\app\controllers\AuthController::class, "login"]);
$app->router->post('/login', [\app\controllers\AuthController::class, "login"]);
$app->router->get('/register', [\app\controllers\AuthController::class, "register"]);
$app->router->post('/register', [\app\controllers\AuthController::class, "register"]);
$app->router->get('/logout', [\app\controllers\AuthController::class, "logout"]);
$app->router->get('/profile', [\app\controllers\AuthController::class, "profile"]);
$app->router->get('/api/get', [\app\controllers\ApiController::class, "get"]);
$app->router->post('/api/post', [\app\controllers\ApiController::class, "post"]);

$app->run();
