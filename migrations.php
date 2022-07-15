<?php

use app\core\Application;

require_once __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$config = [
    "db" => [
        'localhost' => $_ENV['DB_SERVERNAME'],
        'users' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new Application(__DIR__,$config);

$app->db->applyMigrations();
