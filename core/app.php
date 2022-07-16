<?php

require_once  __DIR__ . '/../plugins/my-custom.php';

use app\core\Application;
use app\models\UsersModel;

$config = [
    'userClass' => UsersModel::class,
    "db" => [
        'localhost' => $_ENV['DB_SERVERNAME'],
        'users' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];
$app = new Application(dirname(__DIR__), $config);
