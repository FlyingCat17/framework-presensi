<?php

use Riyu\Helpers\Errors\AppException;
use Riyu\Helpers\Errors\Message;

if (!function_exists('view')) {
    function view($view = null, $data = [], $mergeData = [])
    {
        try {
            return new App\Config\View($view, $data, $mergeData);
        } catch (\Throwable $th) {
            throw new AppException(Message::exception(500, $view));
        }
    }
}

if (!function_exists('controller')) {
    function controller($class = null, $method = null, $data = null)
    {
        try {
            return new App\Config\Controller($class, $method, $data);
        } catch (\Throwable $th) {
            throw new AppException(Message::exception(500, $class));
        }
    }
}

if (!function_exists('redirect')) {
    function redirect($url = null)
    {
        try {
            return new App\Config\Redirect($url);
        } catch (\Throwable $th) {
            throw new AppException(Message::exception(100, $url));
        }
    }
}
