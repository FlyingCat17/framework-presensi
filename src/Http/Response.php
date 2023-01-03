<?php
namespace Riyu\Http;

class Response
{
    private static $content;

    private static $code;

    private static $method;

    private static $headers;

    private static $cookies;

    public function __construct($content = '', $code = 200, $method = 'GET', $headers = [], $cookies = [])
    {
        $this->content = $content;
        $this->code = $code;
        $this->method = $method;
        $this->headers = $headers;
        $this->cookies = $cookies;
    }

    public static function code($code = 200)
    {
        self::$code = $code;
        return (new static);
    }

    public static function setMethod($method = 'GET')
    {
        self::$method = $method;
        return (new static);
    }

    public static function redirect($url = '/')
    {
        header('Location: ' . $url);
        exit;
    }

    public static function setHeaderType($type = 'text/html')
    {
        self::setHeader('Content-Type: ' . $type);
        return (new static);
    }

    public static function setHeader($header = "Content-Type: text/html")
    {
        self::$headers[] = $header;
        return (new static);
    }

    public static function setCookie($cookie = "name=value")
    {
        self::setHeader('Set-Cookie: ' . $cookie);
    }

    public static function setCookies($cookie = [])
    {
        foreach ($cookie as $key => $value) {
            self::setCookie($key . '=' . $value);
        }

        return (new static);
    }

    public static function content($content)
    {
        self::$content = $content;
        return (new static);
    }

    public static function json($content)
    {
        self::setHeaderType('application/json');
        self::$content = json_encode($content);
        return (new static);
    }

    public static function hasCode()
    {
        return self::$code !== null;
    }

    public static function hasMethod()
    {
        return self::$method !== null;
    }

    public static function hasHeaders()
    {
        return self::$headers !== null;
    }

    public static function hasCookies()
    {
        return self::$cookies !== null;
    }

    public static function hasContent()
    {
        return self::$content !== null;
    }

    public static function send()
    {
        if (self::hasCode()) {
            http_response_code(self::$code);
        }

        if (self::hasMethod()) {
            $_SERVER['REQUEST_METHOD'] = self::$method;
        }

        if (self::hasHeaders()) {
            foreach (self::$headers as $header) {
                header($header);
            }
        }

        if (self::hasCookies()) {
            foreach (self::$cookies as $cookie) {
                setcookie($cookie);
            }
        }

        if (self::hasContent()) {
            echo self::$content;
        }
    }

    public static function sendJson($content)
    {
        self::json($content)->send();
    }

    public static function sendContent($content)
    {
        self::content($content)->send();
    }
}