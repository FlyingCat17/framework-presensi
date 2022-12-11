<?php
namespace Riyu\Database\Utils;

use Riyu\Database\Events\Builder;
use Riyu\Database\Connection\Connection;
use Riyu\Database\Connection\Event;
use Riyu\Database\Connection\Manager;
use Riyu\Database\Connection\Storage;
use Riyu\Helpers\Errors\AppException;
use Riyu\Helpers\Errors\Message;
use Riyu\Helpers\Storage\GlobalStorage;

abstract class Model
{
    protected $table;

    protected $fillable;

    protected $prefix;

    protected $timestamp;

    protected static $builder;

    private $connection;

    protected static $errorHandle;

    public function __construct()
    {
        self::$builder = new Builder();
        $this->booting();
    }

    public static function __callStatic($method, $args)
    {
        return (new static)->$method(...$args);
    }

    public function __call($method, $args)
    {
        if (method_exists($this, $method)) {
            return $this->$method(...$args);
        }

        if (method_exists(self::$builder, $method)) {
            return self::$builder->$method(...$args);
        }

        throw new AppException(Message::exception(4, $method), 4);
    }

    private function booting()
    {
        if (is_null($this->table)) {
            $this->table = strtolower((new \ReflectionClass($this))->getShortName());
        }

        if (!is_null($this->prefix)) {
            $this->table = $this->prefix . $this->table;
        }
        
        self::$builder->setTable($this->table);
        self::$builder->setFillable($this->fillable);
        self::$errorHandle = new Message();
        $this->isBooting();
        $this->connection();
    }

    public function isBooting()
    {
        if ($this->timestamp == true) {
            self::$builder->setTimestamp(true);
        } else {
            self::$builder->setTimestamp(false);
        }
    }

    private function connection()
    {
        $this->connection = (new Event)->connect();
        self::$builder->connection(new Manager($this->connection));
    }

    public function __sleep()
    {
        $this->connection = null;
    }

    public function __wakeup()
    {
        $this->connection();
    }
}
