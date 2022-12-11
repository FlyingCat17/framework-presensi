<?php

namespace Riyu\Http;

class Request
{
    protected static $path;

    protected static $query;

    protected static $method;

    protected static $uri;

    protected static $fullUrl;

    protected static $fragment;

    public static function uri()
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        self::$uri = $uri;
        return $uri;
    }

    public static function method()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        self::$method = $method;
        return $method;
    }

    public function __construct()
    {
        $this->booting($this);
    }

    public static function fullUrl()
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        self::$fullUrl = $url;
        return $url;
    }

    public static function baseUrl()
    {
        $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        return $baseUrl;
    }

    public static function getPath()
    {
        $path = parse_url(self::fullUrl(), PHP_URL_PATH);
        self::$path = $path;
        return $path;
    }

    public static function getQuery()
    {
        $query = parse_url(self::fullUrl(), PHP_URL_QUERY);
        $query = $query ? $query : null;
        self::$query = $query;
        return $query;
    }

    public static function getFragment()
    {
        $fragment = parse_url(self::fullUrl(), PHP_URL_FRAGMENT);
        $fragment = $fragment ? $fragment : null;
        self::$fragment = $fragment;
        return $fragment;
    }

    public function __toString()
    {
        return json_encode($this->__debugInfo());
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function set($value = null)
    {
        if (is_array($value)) {
            foreach ($value as $key => $val) {
                $this->$key = $val;
            }
        } else {
            $this->request = $value;
        }
    }

    public static function getRoute()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = explode('/', $url);
        $url = array_filter($url);
        $url = array_values($url);
        $url = array_slice($url, 1);
        $url = implode('/', $url);
        return "/" . $url;
    }

    public function __debugInfo()
    {
        return [
            'request' => $this->request,
            'query' => $this->getQuery(),
            'fragment' => $this->getFragment(),
            'path' => $this->getPath(),
            'fullUrl' => $this->fullUrl(),
            'method' => $this->method(),
            'uri' => $this->uri(),
        ];
    }

    public function __invoke()
    {
        return $this;
    }

    public static function all()
    {
        $request = array();
        if (isset($_POST)) {
            $request = array_merge($request, $_POST);
        }

        $json = file_get_contents('php://input');
        if ($json && is_array(json_decode($json, true))) {
            $request = array_merge($request, json_decode($json, true));
        }

        if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'multipart/form-data') !== false) {
            $request = array_merge($request, $_POST);
        }

        if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded') !== false) {
            $request = array_merge($request, $_POST);
        }

        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'PUT') {
            parse_str(file_get_contents('php://input'), $put);
            $request = array_merge($request, $put);
        }

        if (isset($_GET)) {
            $request = array_merge($request, $_GET);
        }

        if (isset($_FILES)) {
            $request = array_merge($request, $_FILES);
        }

        return $request;
    }

    public static function booting(Request $request)
    {
        if (isset($_POST)) {
            $request->set($_POST);
        }

        $json = file_get_contents('php://input');
        if ($json) {
            $request->set(json_decode($json, true));
        }

        if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'multipart/form-data') !== false) {
            $request->set($_POST);
        }

        if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded') !== false) {
            $request->set($_POST);
        }

        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'PUT') {
            parse_str(file_get_contents('php://input'), $put);
            $request->set($put);
        }

        if (isset($_GET)) {
            $request->set($_GET);
        }

        if (isset($_FILES)) {
            $request->set($_FILES);
        }

        if (isset($_COOKIE)) {
            $request->set($_COOKIE);
        }

        if (isset($_SESSION)) {
            $request->set($_SESSION);
        }
    }

    public static function __callStatic($name, $arguments)
    {
        $request = new Request();
        return $request->$name(...$arguments);
    }

    public function __call($name, $arguments)
    {
        return $this->$name(...$arguments);
    }
}