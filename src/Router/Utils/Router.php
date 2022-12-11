<?php

namespace Riyu\Router\Utils;

use Riyu\Router\Utils\Storage;
use Riyu\Router\Utils\Foundation;

abstract class Router
{
    public static function get($uri, $callback)
    {
        Storage::addRoute($uri, "GET", $callback);
    }

    public static function post($uri, $callback)
    {
        Storage::addRoute($uri, "POST", $callback);
    }

    public static function put($uri, $callback)
    {
        Storage::addRoute($uri, "PUT", $callback);
    }

    public static function delete($uri, $callback)
    {
        Storage::addRoute($uri, "DELETE", $callback);
    }

    public static function patch($uri, $callback)
    {
        Storage::addRoute($uri, "PATCH", $callback);
    }

    public static function prefix($prefix)
    {
        Storage::addPrefix($prefix);
        return new static;
    }

    public static function __callStatic($name, $arguments)
    {
        return (new static)->$name(...$arguments);
    }

    public function __call($name, $arguments)
    {
        return (new static)->$name(...$arguments);
    }

    public static function getRoutes()
    {
        return Storage::getRoutes();
    }

    public static function getRoute($name)
    {
        return Storage::getRoute($name);
    }

    public static function getPrefix()
    {
        return Storage::getPrefix();
    }

    public static function setRoutes($routes, $method)
    {
        Storage::setRoutes($routes, $method);
    }

    public static function setPrefix($prefix)
    {
        Storage::setPrefix($prefix);
    }

    public static function addRoute($uri, $method, $callback)
    {
        Storage::addRoute($uri, $method, $callback);
    }

    public static function addPrefix($prefix)
    {
        Storage::addPrefix($prefix);
    }

    public function __invoke()
    {
        $callback = func_get_arg(0);
        $callback(new static);
    }

    public static function toRoute($uri, $method)
    {
    }
}
