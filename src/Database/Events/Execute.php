<?php

namespace Riyu\Database\Events;

use Riyu\Database\Events\BuildQuery;

class Execute extends BuildQuery
{
    /**
     * Options for query
     * 
     * @var string
     */
    protected $options;

    /**
     * Connection for query
     * 
     * @var object
     */
    protected $connection;

    /**
     * Set Connection for query
     * 
     * @return this
     */
    public function connection($connection)
    {
        $this->connection = $connection;
        return $this;
    }

    /**
     * Build query for select all
     * 
     * @return function
     */
    public function all()
    {
        $this->query = $this->buildSelect();
        return $this->responseAll();
    }

    /**
     * Build query for select get
     * 
     * @return function
     */
    public function get()
    {
        $this->query = $this->buildSelect();
        return $this->responseGet();
    }

    /**
     * Build query for select first
     * 
     * @return function
     */
    public function first()
    {
        $this->query = $this->buildSelect(1);
        return $this->responseSingle();
    }

    /**
     * Rows count
     * 
     * @return int
     */
    public function count()
    {
        $this->query = $this->buildSelect();
        return $this->connection->count($this->query, $this->options);
    }

    /**
     * Response for select first
     * 
     * @return object
     */
    private function responseSingle()
    {
        return $this->connection->queryFirst($this->query, $this->options);
    }

    /**
     * Response for select get
     * 
     * @return array
     */
    private function responseGet()
    {
        return $this->connection->queryGet($this->query, $this->options);
    }

    /**
     * Response for select all
     * 
     * @return array
     */
    private function responseAll()
    {
        return $this->connection->queryAll($this->query, $this->options);
    }

    /**
     * Handle query save
     * 
     * @return function
     */
    public function save()
    {
        return $this->eventSave();
    }

    /**
     * Execute query
     * 
     * @return
     */
    private function exec()
    {
        return $this->connection->execute($this->query, $this->options);
    }

    /**
     * Build query for select count
     * 
     * Execute query
     * 
     * @return function
     */
    private function eventSave()
    {
        if (!is_null($this->update)) {
            $this->query = $this->buildUpdate();
            return $this->exec();
        } else if (!is_null($this->insert)) {
            $this->query = $this->buildInsert();
            return $this->exec();
        } else if (!is_null($this->isDelete)) {
            $this->query = $this->buildDelete();
            return $this->exec();
        } else if ($this->resetIncrement) {
            $this->query = $this->buildResetIncrement();
            return $this->exec();
        } else {
            throw new \Exception("No data to save", 1029);
        }
    }
}
