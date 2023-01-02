<?php
namespace Riyu\Helpers\Errors\Handler;

use Riyu\Helpers\Errors\Handler\Contract\System as ContractSystem;

class System implements ContractSystem
{
    private $isSafety;

    public function register($safety = false)
    {
        $this->isSafety = $safety;
        set_error_handler([$this, 'handle']);
        set_exception_handler([$this, 'exception']);
        register_shutdown_function([$this, 'shutdown']);
    }

    public function handle($errno, $errstr, $errfile, $errline)
    {
        if ($this->isSafety) {
            throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        }
    }

    public function shutdown()
    {
        $error = error_get_last();
        if ($error) {
            $this->handle($error['type'], $error['message'], $error['file'], $error['line']);
        }
    }

    public function exception($exception)
    {
        $this->handleLog($exception);
        $this->unregister();
        $this->render($exception);
    }

    public function handleLog($exception)
    {
        if (!empty($exception->getMessage())) {
            $log = new Logger();
            $log->write($exception->getCode(), $exception->getMessage(), $exception->getFile(), $exception->getLine());
        }
    }

    public function render($exception)
    {
        $view = new View();
        $view->render($exception, $this->isSafety);
    }

    public function unregister()
    {
        restore_error_handler();
        restore_exception_handler();
        set_error_handler([$this, 'errorLog']);
    }

    public function errorLog($errno, $errstr, $errfile, $errline)
    {
        $this->handleLog(new \ErrorException($errstr, 0, $errno, $errfile, $errline));
    }
}
