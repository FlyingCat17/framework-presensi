<?php 
namespace Riyu\Database\Connection;

use PDO;
use PDOException;
use Riyu\App\Config;
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
     * Default options for database
     * 
     * @var array
     */
    private $options = [
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
        PDO::ATTR_STRINGIFY_FETCHES => false,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    /**
     * Constructor for Event
     * 
     * @return void
     */
    public function __construct()
    {
        if (Config::has('database')) {
            $this->config = Config::get('database');
        } else if (GlobalStorage::has('database')) {
            $this->config = GlobalStorage::get('db');
        } else {
            throw new AppException("Database config not found");
        }
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
        $dsn = '';

        if (isset($this->config['driver'])) {
            $dsn .= $this->config['driver'] . ':';
        } else {
            throw new AppException("Driver not found");
        }

        if (isset($this->config['host'])) {
            $dsn .= 'host=' . $this->config['host'] . ';';
        } else {
            throw new AppException("Host not found");
        }

        if (isset($this->config['port'])) {
            $dsn .= 'port=' . $this->config['port'] . ';';
        } else {
            throw new AppException("Port not found");
        }

        if (isset($this->config['database'])) {
            $dsn .= 'dbname=' . $this->config['database'] . ';';
        } else {
            throw new AppException("Dbname not found");
        }

        if (isset($this->config['charset'])) {
            $dsn .= 'charset=' . $this->config['charset'] . ';';
        } else {
            throw new AppException("Charset not found");
        }

        $this->dsn = $dsn;
    }

    /**
     * Set connection for database
     * 
     * @return void
     */
    public function setConnection()
    {
        if (isset($this->config['username'])) {
            $username = $this->config['username'];
        } else {
            throw new AppException("Username not found");
        }

        if (isset($this->config['password'])) {
            $password = $this->config['password'];
        } else {
            throw new AppException("Password not found");
        }

        if (isset($this->config['options'])) {
            $options = $this->config['options'];
        } else {
            $options = $this->options;
        }

        try {
            $this->connection = new PDO($this->dsn, $username, $password, $options);
            return $this->connection;
        } catch (AppException $e) {
            new AppException("Connection to database failed");
        }
    }

    public function raw()
    {
        $dsn = '';

        if (isset($this->config['driver'])) {
            $dsn = $this->config['driver'] . ':';
        } else {
            throw new AppException("Driver not found");
        }

        if (isset($this->config['host'])) {
            $dsn .= 'host=' . $this->config['host'] . ';';
        } else {
            throw new AppException("Host not found");
        }

        if (isset($this->config['port'])) {
            $dsn .= 'port=' . $this->config['port'] . ';';
        } else {
            throw new AppException("Port not found");
        }

        if (isset($this->config['charset'])) {
            $dsn .= 'charset=' . $this->config['charset'] . ';';
        } else {
            throw new AppException("Charset not found");
        }

        if (isset($this->config['username'])) {
            $username = $this->config['username'];
        } else {
            throw new AppException("Username not found");
        }

        if (isset($this->config['password'])) {
            $password = $this->config['password'];
        } else {
            throw new AppException("Password not found");
        }

        if (isset($this->config['options'])) {
            $options = $this->config['options'];
        } else {
            $options = $this->options;
        }

        try {
            $connection = new PDO($dsn, $username, $password, $options);
            return $connection;
        } catch (AppException $e) {
            new AppException("Connection to database failed");
        }
    }
}