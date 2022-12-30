<?php
namespace Riyu\Helpers\Errors\Backtrace\Handler;

class Backtrace {
    protected $trace;

    public function __construct() {
        $this->trace = debug_backtrace();
        return $this->render();
    }

    public function render()
    {
        require_once __DIR__ .'/../resources/view.php';
        exit;
    }

    public function getBackTrace()
    {
        $trace = $this->removeAppException();
        return $trace;
    }

    public function removeAppException()
    {
        $trace = $this->trace;
        $trace = array_slice($trace, 1);
        return $trace;
    }

    public function assets($assetsName)
    {
        $dir = __DIR__ . '/../resources/';
        $file = $dir . $assetsName;
        if (file_exists($file)) {
            require_once $file;
        }
    }
}
