<?php

namespace Riyu\Router;

use Riyu\Helpers\Callback\Callback;
use Riyu\Helpers\Errors\AppException;
use Riyu\Helpers\Errors\Message;
use Riyu\Helpers\Errors\ViewError;
use Riyu\Http\Request;
use Riyu\Router\Utils\Foundation;
use Riyu\Router\Utils\Storage;

class Matches extends Storage
{
    /**
     * @var Request
     */
    protected $request;

    public function __construct()
    {
        $this->request = new Request;
        $this->match($this->request->getRoute(), $this->request->method());
    }

    public function match($uri, $method)
    {
        $routes = self::getRoutes();
        $url = $uri;
        $uri = $this->pregReplace($uri);
        if ($method == "HEAD") {
            $method = "GET";
        }
        foreach ($routes[$method] as $route) {
            if (preg_match($uri, $route)) {
                try {
                    return $this->callback($route, $method);
                } catch (\Throwable $th) {
                    throw new AppException(Message::exception(501, [$route, $method]));
                }
            }
            $rout = $this->pregReplaceRoute($route);
            if (preg_match($rout, $url)) {
                try {
                    return $this->callback($route, $method);
                } catch (\Throwable $th) {
                    throw new AppException(Message::exception(501, [$route, $method]));
                }
            }
        }
        $this->matchGroup($url, $method);
    }

    public function matchGroup($uri, $method)
    {
        $routes = self::getRoutes();
        $prefix = self::getPrefix();
        $url = $uri;
        $uri = $prefix . $uri;
        $uri = $this->pregReplace($uri);
        if ($method == "HEAD") {
            $method = "GET";
        }
        foreach ($routes[$method] as $route) {
            if (preg_match($uri, $route)) {
                try {
                    return $this->callback($route, $method);
                } catch (\Throwable $th) {
                    throw new AppException(Message::exception(501, [$route, $method]));
                }
            }
            $rout = $this->pregReplaceRoute($route);
            if (preg_match($rout, $url)) {
                return $this->callback($route, $method);
            }
        }
        return ViewError::code(404);
    }

    public function callback($route, $method)
    {
        $routes = self::getRoutes();
        $methods = self::getMethods();
        $params = Foundation::getParams($route);
        $callback = $methods[$method];
        $callback = $callback[array_search($route, $routes[$method])];
        try {
            Storage::clearAll();
            return Callback::call($callback, $params);
        } catch (\Throwable $th) {
            throw new AppException(Message::exception(501, [$callback, $params]));
        }
    }

    public function pregReplace($uri)
    {
        $uri = preg_replace('/\//', '\/', $uri);
        $uri = preg_replace('/\{[a-zA-Z0-9]+\}/', '([a-zA-Z0-9]+)', $uri);
        $uri = '/^' . $uri . '$/';
        return $uri;
    }

    public function pregReplaceRoute($route)
    {
        $route = preg_replace('/\//', '\/', $route);
        $route = preg_replace('/\{[a-zA-Z0-9]+\}/', '([a-zA-Z0-9]+)', $route);
        $route = '/^' . $route . '$/';
        return $route;
    }
}
