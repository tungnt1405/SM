<?php
require_once  __DIR__ . '/../core/app.php';

$app->router->get('/', function(){
    return 'Hello World';
});

$app->router->get('/aa', function(){
    return 'Hello World';
});

$app->run();