<?php

namespace app\core;

use PDOException;

abstract class DbModel extends Model
{
    abstract public function tableName():string;
    abstract public function attributes():array;

    public function save()
    {
        $tabelName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr",$attributes);
        $statement = self::prepare("INSERT INTO $tabelName (".implode(',', $attributes).")
                    VALUES (".implode(',', $params).")");

        foreach ($attributes as $attr)
        {
            $statement->bindValue(":$attr", $this->{$attr});
        }
        $statement->execute();
        return true;
    }

    public static function prepare($sql)
    {
        try {
            return Application::$app->db->pdo->prepare($sql);
        }catch(PDOException $e) {
            return $sql . "<br>" . $e->getMessage();
        }
    }
}