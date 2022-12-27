<?php

namespace Riyu\Helpers\Errors;

use Exception;
use Riyu\App\Config;
use Throwable;

class AppException extends Exception
{
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        http_response_code(500);
        parent::__construct($message, $code, $previous);
        $config = Config::get('app');
        if ($config['debug']) {
            return new Backtrace;
            exit;
        } else {
            return ViewError::code(500);
            exit;
        }
    }

    final public static function msg()
    {
        return self::$message;
    }

    final public function code()
    {
        return $this->code;
    }

    final public function previous()
    {
        return $this->previous;
    }
}
