<?php 
namespace Riyu\Database\Connection;

use PDO;
use PDOException;
use Riyu\Helpers\Errors\AppException;
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
     * @return object pdo
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
            return $this->connection;
        } catch (PDOException $e) {
            new AppException("Connection failed: " . $e->getMessage());
        }
    }

    public function raw()
    {
        $dsn = $this->config[0] . ':host=' . $this->config[1] . ';charset=' . $this->config[5] . ';port=' . $this->config[6];
        $this->setDsn();
        $connection = $this->dsn;
        try {
            $connection = new PDO($dsn, $this->config[2], $this->config[3]);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (\Throwable $th) {
            throw new AppException("Connection failed: " . $th->getMessage());
        }
    }
}