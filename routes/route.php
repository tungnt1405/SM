<?php

$app->router->get('/', [\app\controllers\PagesController::class,"index"]);
$app->router->get('/login', [\app\controllers\AuthController::class,"login"]);
$app->router->get('/register', [\app\controllers\AuthController::class,"register"]);
$app->router->post('/register', [\app\controllers\AuthController::class,"register"]);

$app->run();