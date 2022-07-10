<?php

namespace app\core;
/**
 * file nhận các response từ server
 * sau đó tiếp nhận thông tin và xử lý truyền về cho application và route
 */
class Response
{
    public function setStatusCode(int $StatusCode){
        http_response_code($StatusCode);
    }
}