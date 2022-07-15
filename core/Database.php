<?php

namespace app\core;

class Database{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $db_servername = $config['localhost'] ?? '';
        $db_username = $config['users'] ?? 'root';
        $db_password = $config['password'] ?? '';
        try {
            $this->pdo = new \PDO($db_servername, $db_username, $db_password);
            // set the \PDO error mode to exception
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}