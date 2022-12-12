<?php 
namespace Riyu\Database\Connection;

use PDO;
use PDOException;
use Riyu\Helpers\Errors\AppException;
use Riyu\Helpers\Errors\Message;
use Riyu\Helpers\Storage\GlobalStorage;

class Event
{
    /**
     * Connection for database
     * 
     * @var pdo
     */
    protected $connection;

    /**
     * Raw config for database
     * 
     * @var string
     */
    private $config;

    /**
     * Dsn for database
     * 
     * @var string
     */
    private $dsn;

    /**
     * Constructor for Event
     * 
     * @return void
     */
    public function __construct()
    {
        $this->config = GlobalStorage::get('db_config');
    }

    /**
     * Connect to database
     * 
     * @return object
     */
    public static function connect()
    {
        $instance = new static;
        $instance->setDsn();
        $instance->setConnection();
        return $instance->connection;
    }

    /**
     * Set dsn for database
     * 
     * @return void
     */
    public function setDsn()
    {
        $this->dsn = $this->config[0] . ':host=' . $this->config[1] . ';dbname=' . $this->config[4] . ';charset=' . $this->config[5] . ';port=' . $this->config[6];
    }

    /**
     * Set connection for database
     * 
     * @return void
     */
    public function setConnection()
    {
        try {
            $this->connection = new PDO($this->dsn, $this->config[2], $this->config[3]);
        } catch (PDOException $e) {
            new AppException(Message::exception(1, $e->getMessage()), 1);
        }
    }
}