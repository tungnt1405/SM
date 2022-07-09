<?php

namespace app\core;

class Request
{
    public function getPath(){
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position === false){
            return $path;
        }

        return substr($path, 0, $position);// lấy đường dẫn gốc tính từ vị trí 0 cho đến vị trí xuất hiện ?
    }

    public function getMethod(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}