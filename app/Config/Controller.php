<?php

namespace App\Config;

class Controller
{
    protected $method;

    public $data;

    protected $class;

    public function __construct($class = null, $method = null, $data = null)
    {
        $this->method = $method;
        $this->data = $data;
        $this->class = $class;
        $this->render();
    }

    public function render()
    {
        $class = $this->class;
        $method = $this->method;
        $data = $this->data;
        if (class_exists($class)) {
            $class = new $class();
            if (method_exists($class, $method)) {
                return $class->$method($data);
            } else {
                return $class->index($data);
            }
        }

        if (file_exists(__DIR__ . "/../Controllers/{$class}.php")) {
            require_once __DIR__ . "/../Controllers/{$class}.php";
            $class = "App\\Controllers\\{$class}";
            $class = new $class;
            if (method_exists($class, $method)) {
                return $class->$method($data);
            } else {
                return $class->index($data);
            }
        }

        if (class_exists($class)) {
            $class = new $class();
            if (method_exists($class, $method)) {
                return $class->$method($data);
            } else {
                return $class->index($data);
            }
        }

        http_response_code(404);
    }
}
