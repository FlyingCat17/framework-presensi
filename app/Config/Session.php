<?php

namespace App\Config;

class Session
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($name, $value = null)
    {
        if (is_array($name)) {
            foreach ($name as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }

        if (!is_null($value)) {
            $_SESSION[$name] = $value;
        }
    }

    public static function get($name)
    {
        if (!isset($_SESSION[$name])) {
            return null;
        }
        return $_SESSION[$name];
    }

    public static function unset($name)
    {
        unset($_SESSION[$name]);
    }

    public static function destroyAll()
    {
        session_destroy();
    }

    public static function __callStatic($name, $arguments)
    {
        return (new static)->$name(...$arguments);
    }

    public function __call($name, $arguments)
    {
        return (new static)->$name(...$arguments);
    }
}
