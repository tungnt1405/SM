<?php

declare(strict_types=1);


namespace App\Handler;

class Handler
{
    public function exec(array $params = []): void
    {
        $name = $params['name'] ?? 'Guest';
        require_once __DIR__ . '../../../Views/welcome.php';
    }
}
