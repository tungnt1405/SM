<?php

namespace app\core\exception;

use Exception;

class NotFoundException extends Exception
{
    protected $message = 'Not Found';
    protected $code = 404;
}