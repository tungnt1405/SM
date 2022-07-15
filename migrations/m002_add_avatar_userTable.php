<?php

use app\core\Application;
class m002_add_avatar_userTable
{
    public function up()
    {
        $db = Application::$app->db;

        $SQL = "ALTER TABLE users ADD COLUMN avatar VARCHAR(255) NOT NULL";

        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = Application::$app->db;

        $SQL = 'ALTER TABLE users DROP COLUMN avatar;';

        $db->pdo->exec($SQL);
    }
}