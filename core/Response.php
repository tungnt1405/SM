<?php

namespace app\core;

class Response
{
    public function setStatusCode(int $StatusCode){
        http_response_code($StatusCode);
    }
}