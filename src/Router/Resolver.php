<?php

namespace Riyu\Router;

use Closure;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;
use Riyu\Helpers\Errors\AppException;
use Riyu\Helpers\Errors\Message;
use Riyu\Http\Request;

class Resolver
{
    public static function aliases()
    {
        return [
            'request' => Request::class,
        ];
    }

    public static function resolveClass($class)
    {
        $aliases = self::aliases();
        if (!is_null($class) && is_string($class)) {
            if (array_key_exists($class, $aliases)) {
                return $aliases[$class];
            }
        }
        return $class;
    }

    public static function resolveMethod($class, $method)
    {
        try {
            $class = self::resolveClass($class);
            $class = new $class;
            return $class->$method();
        } catch (\Throwable $th) {
            throw new AppException(Message::exception(500));
        }
    }

    public static function resolveData($class, $method, $data)
    {
        try {
            $arguments = self::getArgument($class, $method);
            $arguments = self::resolveClass($arguments[0]->name);
            if (isset($arguments) && $arguments != null) {
                if (!in_array($arguments, self::aliases())) {
                    $class = new $class;
                    return $class->$method($data);
                }
                $arguments = new $arguments;
                $arguments->set($data);
                return $class->$method($arguments);
            } else {
                return $class->$method($data);
            }
        } catch (\Throwable $th) {
            throw new AppException(Message::exception(500));
        }
    }

    public static function resolveDataWithParams($class, $method, $data, $params)
    {
        try {
            $class = self::resolveClass($class);
            $class = new $class;
            return $class->$method($data, $params);
        } catch (\Throwable $th) {
            throw new AppException(Message::exception(500));
        }
    }

    public static function resolveWithParams($class, $method, $params)
    {
        try {
            $args = self::resolveClass($params[0]->name);
            if (isset($args) && $args != null) {
                $args = new $args;
                return $class->$method($args);
            } else {
                return $class->$method(json_encode($params));
            }
        } catch (\Throwable $th) {
            throw new AppException(Message::exception(500));
        }
    }

    public static function resolve($callback, $data = null)
    {
        try {
            if ($callback instanceof Closure) {
                if ($data == null) {
                    return $callback();
                }
                $class = self::resolveClosure($callback);
                $resolve = self::resolveClass($class[0]);
                if ($class[0] == 'Riyu\Http\Request') {
                    $resolve = new $resolve;
                    return $callback($resolve);
                }
                if ($class[0] == 'request') {
                    $resolve = new $resolve;
                    return $callback($resolve);
                }
                return $callback($data);
            } else {
                $class = new ReflectionClass($callback);
                $class = $class->name;
            }
        } catch (\Throwable $th) {
            throw new AppException(Message::exception(500));
        }
    }

    public static function resolveClosure(Closure $closure)
    {
        try {
            $class = new ReflectionFunction($closure);
            $class = $class->getParameters();
            foreach ($class as $key => $value) {
                $class[$key] = $value->name;
            }
            return $class;
        } catch (\Throwable $th) {
            throw new AppException(Message::exception(500));
        }
    }

    public static function getArgument($class, $method)
    {
        $tmp = new ReflectionMethod($class, $method);
        return $tmp->getParameters();
    }

    public static function __callStatic($name, $arguments)
    {
        if (method_exists(self::class, $name)) {
            return self::$name(...$arguments);
        }
    }

    public function __call($name, $arguments)
    {
        if (method_exists(self::class, $name)) {
            return self::$name(...$arguments);
        }
    }
}
