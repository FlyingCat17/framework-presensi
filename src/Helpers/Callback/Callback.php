<?php

namespace Riyu\Helpers\Callback;

use ReflectionMethod;
use Riyu\Helpers\Errors\AppException;
use Riyu\Router\Resolver;

class Callback
{
    public static function call($callback, $data = null)
    {
        if (is_array($callback)) {
            $class = new $callback[0];
            $method = $callback[1];
            if (isset($method) && $method != null) {
                $tmp = new ReflectionMethod($class, $method);
                $params = $tmp->getParameters();
                if (count($params) > 0) {
                    if ($data != null) {
                        return Resolver::resolveData($class, $method, $data);
                    } else {
                        return Resolver::resolveWithParams($class, $method, $params);
                    }
                } else {
                    if ($data != null) {
                        return Resolver::resolveData($class, $method, $data);
                    } else {
                        return Resolver::resolveMethod($class, $method);
                    }
                }
            } else {
                self::callable($callback, $data);
            }
        } else {
            self::object($callback, $data);
        }
    }

    private static function object($callback, $data = null)
    {
        if (is_object($callback)) {
            return Resolver::resolve($callback, $data);
        } else {
            self::callable($callback, $data);
        }
    }

    private static function callable($callback, $data = null)
    {
        if (is_callable($callback)) {
            if ($data != null) {
                return $callback($data);
            } else {
                return $callback();
            }
        } else {
            if (is_array($callback)) {
                $class = new $callback[0];
                $method = $callback[1];
                if ($method == null) {
                    return $class->index();
                } else {
                    return $class->$method();
                }
            } else {
                return $callback();
            }
        }
    }
}
