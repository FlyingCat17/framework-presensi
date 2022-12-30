<?php

namespace Riyu\Helpers\Errors;

use Exception;
use Riyu\App\Config;
use Riyu\Helpers\Errors\Backtrace\Handler\Backtrace;
use Throwable;

class AppException extends Exception
{
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        http_response_code(500);
        try {
            new \Riyu\Helpers\Errors\Backtrace\Handler\Logging();
        } catch (\Throwable $th) {
        }
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
