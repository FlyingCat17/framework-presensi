<?php

namespace Riyu\Helpers\Errors\Backtrace\Handler;

use Riyu\App\Config;

class Logging
{
    protected $logs;

    protected $path;

    protected $trace;

    const LINE = '------------------------------------------------------------------------------------------------------------------------------------';
    const UNDERLINE = '____________________________________________________________________________________________________________________________________';

    public function __construct(int $type = E_ALL)
    {
        $this->path = Config::get('path') . 'storage/';
        $this->logs = $this->path . 'logs/';
        error_reporting($type);
        $this->trace = debug_backtrace();
        return $this->render();
    }

    public function render()
    {
        $trace = $this->removeAppException();
        $this->isValid();
        if ($this->isDebug()) {
            $file = $this->logs . 'Debug.log';
            $content = $this->getContent($trace);
        } else {
            $file = $this->logs . 'Log.log';
            $content = $this->getContentNoDebug($trace);
        }
        $this->write($file, $content);
    }

    public function removeAppException()
    {
        $trace = $this->trace;
        $trace = array_slice($trace, 1);
        return $trace;
    }

    public function getContent($trace)
    {
        $content = '';
        foreach ($trace as $key => $value) {
            $content = $this->content($content, $value);
        }
        return $content;
    }

    public function write($file, $content)
    {
        $raw = $file;
        if (!file_exists($file)) {
            $file = fopen($file, 'w');
            fclose($file);
        }
        $file = fopen($raw, 'a');
        fwrite($file, $content);
        fclose($file);
    }

    public function isValid()
    {
        if (!is_dir($this->path)) {
            mkdir($this->path, 0777, true);
        }
        if (!is_dir($this->path)) {
            mkdir($this->path, 0777);
        }
        if (!is_writable($this->path)) {
            chmod($this->path, 0777);
        }
        if (!is_dir($this->logs)) {
            mkdir($this->logs, 0777, true);
        }
        if (!is_dir($this->logs)) {
            mkdir($this->logs, 0777);
        }
        if (!is_writable($this->logs)) {
            chmod($this->logs, 0777);
        }
    }

    public function isDebug()
    {
        $config = Config::get('app');
        if ($config['debug']) {
            return true;
        }
        return false;
    }

    public function getContentNoDebug($trace)
    {
        $content = '';
        foreach ($trace as $key => $value) {
            $content = $this->content($content, $value);
            break;
        }
        return $content;
    }

    public function content($content, $value)
    {
        $date = date('Y-m-d H:i:s');
        $content .= "[{$date}] ";
        $content .= "Line {$value['line']} "; 
        $content .= "{$value['file']} ";
        $content .= PHP_EOL;
        return $content;
    }

    public function validation($value, $key)
    {
        if (!isset($value[$key])) {
            return '';
        }

        if (is_object($value[$key])) {
            return get_class($value);
        }

        if (is_array($value[$key])) {
            foreach ($value[$key] as $index => $data) {
                return $this->validation($data, $index);
            }
        }

        return $value[$key];
    }
}
