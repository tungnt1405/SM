<?php

namespace app\core;

class Response
{
    public function httpStatusCode($status)
    {
        return http_response_code($status);
    }

    public function redirect($url)
    {
        header('Location: '. $url);
    }
}