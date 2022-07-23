<?php

use app\core\Application;

class m003_manageTable
{
    public function up()
    {
        $db = Application::$app->db;

        $SQL = "CREATE TABLE manages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            total int NOT NULL,
            month int NOT NULL,
            week_1 int NULL,
            week_2 int NULL,
            week_3 int NULL,
            week_4 int NULL,
            lastest_month int NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            modified TIMESTAMP Null
        ) ENGINE=INNODB;";

        $db->pdo->exec($SQL);
    }
    public function down()
    {
        $db = Application::$app->db;

        $SQL = 'DROP TABLE manages;';

        $db->pdo->exec($SQL);
    }
}
