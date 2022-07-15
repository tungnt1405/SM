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

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$root_path.'/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        // dd($files);

        foreach($toApplyMigrations as $migration){
            if($migration === '.' || $migration === '..'){
                continue;
            }
            require_once(Application::$root_path.'/migrations/'.$migration);
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");

            $newMigrations[] = $migration;
        }

        if(!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        }else{
            $this->log("All migrations are applied");
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations){
        $str = implode(',',array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES
            $str
        ");

        $statement->execute();
    }

    protected function log($message){
        echo '['.date('Y-m-d H:i:s').']-'. $message . PHP_EOL;
    }
}