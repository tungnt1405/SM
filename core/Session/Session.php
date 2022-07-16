<?php

namespace app\core\Session;

class Session
{
    protected const FLASH_MESSAGE = 'flash_messages';
    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_MESSAGE] ?? [];
        if (is_array($flashMessages) || is_object($flashMessages)) {
            foreach ($flashMessages as $key => &$message) {
                //mark to be removed
                $message['remove'] = true;
            }
        }
        $_SESSION[self::FLASH_MESSAGE] = $flashMessages;
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_MESSAGE][$key] = [
            'remove' => false,
            'message' => $message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_MESSAGE][$key]['message'] ?? false;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function __destruct()
    {
        // Iterate over marked to
        $flashMessages = $_SESSION[self::FLASH_MESSAGE] ?? [];
        if (is_array($flashMessages) || is_object($flashMessages)) {
            foreach ($flashMessages as $key => &$message) {
                if ($message['remove']) {
                    unset($flashMessages[$key]);
                }
            }
        }
        $_SESSION[self::FLASH_MESSAGE] = $flashMessages;
    }
}
