<?php
namespace Riyu\Helpers\Errors;

class Backtrace {
    protected $trace;

    public function __construct() {
        $this->trace = debug_backtrace();
        return $this->render();
    }

    public function render()
    {
        require_once __DIR__ .'/view.php';
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
}
