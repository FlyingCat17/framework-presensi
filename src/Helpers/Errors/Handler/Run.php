<?php
namespace Riyu\Helpers\Errors\Handler;

use Riyu\App\Config;

class Run
{
    protected $system;
    protected $view;
    protected $log;

    public function __construct()
    {
        $this->system = new System();
        $this->view = new View();
        $this->log = new Logger();
    }

    public function run()
    {
        $this->running();
    }

    private function running()
    {
        if ($this->isDebug()) {
            $this->system->register($this->isSafety());
        } else {
            $this->system->unregister();
        }
    }

    private function isSafety()
    {
        return Config::get('app')['safety'];
    }

    private function isDebug()
    {
        return Config::get('app')['debug'];
    }

    public function __destruct()
    {
        $this->view->endOb();
        $this->system->unregister();
    }

    public function getOb()
    {
        return $this->view->getOb();
    }

    public function cleanOb()
    {
        $this->view->cleanOb();
    }

    public function flushOb()
    {
        $this->view->flushOb();
    }
}