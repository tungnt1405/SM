<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class SmModel extends Model
{
    public int $id;
    public string $email = '';
    public string $password = '';
    public string $firstname = '';
    public string $lastname = '';
    public int $status;
    public $create_at;
    public string $avatar = '';

    public function select(string $tablename, array $columns = array())
    {
        $result = Application::$app->db->select($tablename, $columns);

        return $result;
    }

    public function rules(): array
    {
        return [];
    }
}
