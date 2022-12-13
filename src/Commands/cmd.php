<?php
namespace Riyu\Commands;

use Riyu\Commands\Helpers\Color;
use Riyu\Commands\Helpers\listcmd;

class cmd
{
    private $help = [
        '--help', '-h', '-help', 'help', 'list', 'list:commands', 'list:cmd',
        '--h', '-H', '-Help', 'Help', 'List', 'List:commands', 'List:cmd',
        'l', 'L',
    ];

    private $create = [
        'create:model', 'create:controller', 'create:route', 'create:database',
    ];

    public function __construct($command)
    {
        if (isset($command[1])) {
            if (in_array($command[1], $this->help)) {
                $this->help($command);
            } else if (in_array($command[1], $this->create)) {
                $this->run($command);
            } else {
                $this->run($command);
            }
        } else {
            $this->help($command);
        }
    }

    public static function run($commands)
    {
        $raw = explode(':', $commands[1]);
        $class = $raw[0];
        $method = $raw[1] ?? null;
        $params1 = $commands[2] ?? null;
        $params2 = $commands[3] ?? null;
        $params3 = $commands[4] ?? null;
        $params = array($params1, $params2, $params3);
        $class = ucfirst($class);

        if ($class == 'create' || $class == 'Create') {
            if ($params2 == '--all') {
                $class = 'Riyu\Commands\Helpers\Create';
                $class = new $class;
                return $class->all($params1);
            }
        }

        if ($commands == 'help' || $class == 'Help') {
            $class = 'Riyu\Commands\Helpers\Help';
            return $class = new $class(...$params);
        }

        if (file_exists(__DIR__ . '/Helpers/' . $class . '.php')) {
            $class = 'Riyu\Commands\Helpers\\' . $class;
            $class = new $class;
            return $class->$method(...$params);
        } else {
            echo "\n";
            echo (new Color)->red("Command not found");
            echo "\n";
            echo "\n";
        }
    }

    public function help($commands)
    {
        $params = $commands[2] ?? '';
        $class = 'Riyu\Commands\Helpers\Help';
        return $class = new $class($params);
    }
}