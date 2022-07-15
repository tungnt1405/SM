<?php

require_once __DIR__.'/vendor/autoload.php';
require_once  __DIR__ . '/plugins/my-custom.php';
// Call route of application
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
require_once  __DIR__ . '/core/app.php';

require_once __DIR__ . '/routes/route.php';