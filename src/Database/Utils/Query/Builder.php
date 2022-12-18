<?php
namespace Riyu\Database\Utils\Query;

use Closure;
use Riyu\Database\Connection\Event;
use Riyu\Database\Connection\Manager;
use Riyu\Helpers\Errors\AppException;
use Riyu\Helpers\Storage\GlobalStorage;

class Builder extends Grammar
{
    use Query;

    /**
     * Query type
     * 
     * @var string
     */
    protected $queryType = 'select';

    /**
     * Query bindings
     * 
     * @var array
     */
    protected $bindings = [];

    /**
     * All Selects
     * 
     * @var array
     */
    protected $selects;

    /**
     * All insert
     * 
     * @var array
     */
    protected $insert = [];

    /**
     * All update
     * 
     * @var array
     */
    protected $update = [];

    /**
     * Check if delete
     * 
     * @var bool
     */
    protected $isDelete;

    /**
     * Join table
     * 
     * @var array
     */
    protected $joins = [];

    /**
     * Where clause
     * 
     * @var array
     */
    protected $where = [];

    /**
     * Group by clause
     * 
     * @var array
     */
    protected $groups;

    /**
     * Order by clause
     * 
     * @var array
     */
    protected $orders;

    /**
     * Having clause
     * 
     * @var array
     */
    protected $having = [];

    /**
     * Limit clause
     * 
     * @var int
     */
    protected $limit;

    /**
     * Offset clause
     * 
     * @var int
     */
    protected $offset;

    /**
     * Query string to be executed
     * 
     * @var string
     */
    protected $query;

    protected $timestamp = [];

    protected $fillable = [];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the query string for debugging
     * 
     * @return string
     */
    public function debug()
    {
        return $this->buildQuery();
    }

    /**
     * Create a new record
     * 
     * @param array|string|args $data
     */
    public function create($data)
    {
        $data = is_array($data) ? $data : func_get_args();
        $this->insert($data);
        return $this->save();
    }

    public function buildQuery()
    {
        $query = '';

        if ($this->queryType == 'select') {
            $query = $this->buildSelect();
        } elseif ($this->queryType == 'insert') {
            $query = $this->buildInsert();
        } elseif ($this->queryType == 'update') {
            $query = $this->buildUpdate();
        } elseif ($this->queryType == 'delete') {
            $query = $this->buildDelete();
        } else {
            $query = $this->buildSelect();
        }

        return $query;
    }

    public function get()
    {
        $query = $this->buildQuery();
        
        $this->setStorage($query);

        $connection = new Event();
        $connection = $connection->connect();

        $exec = new Manager($connection);

        try {
            return $exec->queryGet($query, $this->bindings);
        } catch (\Throwable $th) {
            new AppException("Error Processing Request");
        }
    }

    public function all()
    {
        $query = $this->buildQuery();
        
        $this->setStorage($query);

        $connection = new Event();
        $connection = $connection->connect();

        $exec = new Manager($connection);

        try {
            return $exec->queryAll($query, $this->bindings);
        } catch (\Throwable $th) {
            new AppException("Error Processing Request");
        }
    }

    public function first()
    {
        $this->limit(1);
        $query = $this->buildQuery();
        
        $this->setStorage($query);

        $connection = new Event();
        $connection = $connection->connect();

        $exec = new Manager($connection);

        try {
            return $exec->queryFirst($query, $this->bindings);
        } catch (\Throwable $th) {
            new AppException("Error Processing Request");
        }
    }

    public function count()
    {
        $query = $this->buildQuery();
        
        $this->setStorage($query);

        $connection = new Event();
        $connection = $connection->connect();

        $exec = new Manager($connection);

        try {
            return $exec->queryCount($query, $this->bindings);
        } catch (\Throwable $th) {
            new AppException("Error Processing Request");
        }
    }

    public function save()
    {
        $query = $this->buildQuery();
        
        $this->setStorage($query);

        $connection = new Event();
        $connection = $connection->connect();

        $exec = new Manager($connection);

        try {
            return $exec->exec($query, $this->bindings);
        } catch (\Throwable $th) {
            new AppException("Error Processing Request");
        }
    }

    public function execInsert(array $attributes)
    {
        $this->insert($attributes);
        $query = $this->buildQuery();
        
        $this->setStorage($query);

        $connection = new Event();
        $connection = $connection->connect();

        $exec = new Manager($connection);

        try {
            return $exec->exec($query, $this->bindings);
        } catch (\Throwable $th) {
            new AppException("Error Processing Request");
        }
    }

    public function paginate($page = 1, $limit = 10)
    {
        $this->limit($limit);
        $this->offset(($page - 1) * $limit);
        $query = $this->buildQuery();

        $this->setStorage($query);

        $connection = new Event();
        $connection = $connection->connect();

        $exec = new Manager($connection);

        try {
            return $exec->queryAll($query, $this->bindings);
        } catch (\Throwable $th) {
            new AppException("Error Processing Request");
        }
    }

    protected function setStorage($query)
    {
        $last = preg_replace_callback('/:(\w+)/', function ($matches) {
            if (isset($this->bindings[$matches[0]])) {
                return $this->bindings[$matches[0]];
            } else {
                return $this->bindings[$matches[1]];
            }
        }, $query);
        GlobalStorage::set('last_query', $last);
    }

    public function lastQuery()
    {
        return GlobalStorage::get('last_query');
    }

    public function find($id, $column = null)
    {
        if (is_null($column)) {
            $this->where($id);
            return $this->first();
        }
        $this->where($column, $id);
        return $this->first();

    }

    public function findorfail($id, $column = 'id', Closure $callback = null)
    {
        if ($column instanceof Closure) {
            $tmp = $column;
            $callback = $tmp;
            $column = 'id';
        }
        $this->where($column, $id);
        $this->queryType = 'select';
        $result = $this->first();
        if (empty($result)) {
            if ($callback instanceof Closure) {
                return $callback();
            }
        }
        return $result;
    }

    public function firstWhere($column, $operator = null, $value = null, $boolean = 'AND')
    {
        $this->where($column, $operator, $value, $boolean);
        return $this->first();
    }

    public function truncate()
    {
        $query = "TRUNCATE TABLE {$this->table}";
        GlobalStorage::set('last_query', $query);
        $connection = new Event();
        $connection = $connection->connect();

        $exec = new Manager($connection);

        try {
            return $exec->exec($query);
        } catch (\Throwable $th) {
            new AppException("Error Processing Request");
        }
    }
}