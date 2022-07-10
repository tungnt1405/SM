<?php

/**
 * file nhận các request từ người dùng
 * sau đó tiếp nhận thông tin và xử lý truyền về cho application và route
*/
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

    public function method(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(){
        return $this->method() === 'get';
    }
    public function isPost(){
        return $this->method() === 'post';
    }

    public function getBody(){
        $body = [];
        if($this->method() === 'GET'){
            foreach($_GET as $key => $value){
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if($this->method() === 'POST'){
            foreach($_GET as $key => $value){
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
}