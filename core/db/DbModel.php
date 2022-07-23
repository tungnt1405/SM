<?php

namespace app\core\db;

use app\core\Application;
use app\core\Model;
use PDOException;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;
    abstract public function attributes(): array;
    abstract public function getPrimaryKey(): string;

    public function save()
    {
        $tabelName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn ($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tabelName (" . implode(',', $attributes) . ")
                    VALUES (" . implode(',', $params) . ")");

        foreach ($attributes as $attr) {
            $statement->bindValue(":$attr", $this->{$attr});
        }
        $statement->execute();
        return true;
    }
    public function findOne($where)
    {
        $tabelName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("SELECT * FROM $tabelName WHERE $sql");
        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }
    public static function prepare($sql)
    {
        try {
            return Application::$app->db->pdo->prepare($sql);
        } catch (PDOException $e) {
            return $sql . "<br>" . $e->getMessage();
        }
    }
}
