<?php
require_once  __DIR__ . '/../core/app.php';

$app->router->get('/', 'welcome');

$app->run();