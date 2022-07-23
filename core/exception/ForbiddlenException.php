<?php

namespace app\core\exception;

class ForbiddlenException extends \Exception
{
    protected $message = "You don't have permission to access this page.";
    protected $code = 403;
}