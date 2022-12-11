<?php

namespace Riyu\Database\Events;

class BuildQuery
{
    /**
     * @var string
     */
    protected $insert;
    
    /**
     * @var array
     */
    protected $joins;
    
    /**
     * @var string
     */
    protected $where;
    
    /**
     * @var string
     */
    protected $groupBy;

    /**
     * @var string
     */
    protected $orderBy;

    /**
     * @var bool
     */
    protected $isDelete;
    
    /**
     * @var string
     */
    protected $groups;
    
    /**
     * @var string
     */
    protected $orders;
    
    /**
     * @var string
     */
    protected $update;
    
    /**
     * @var string
     */
    protected $having;
    
    /**
     * @var array
     */
    protected $selects;
    
    /**
     * @var int
     */
    protected $limit;
    
    /**
     * @var string
     */
    protected $query;

    /**
     * @var bool
     */
    protected $timestamp;

    /**
     * @var string
     */
    protected $resetIncrement;

    public function __construct()
    {
        if (is_array($this->selects)) {
            $this->selects = implode(', ', $this->selects);
        }
    }

    /**
     * @param string $option limit
     * @return string query
     */
    public function buildSelect($option = null)
    {
        $query = "SELECT";

        if (!is_null($this->selects)) {
            $query .= ' ' . $this->selects;
        } else {
            $query .= ' *';
        }

        $query .= ' FROM `' . $this->table.'`';

        if (!is_null($this->joins)) {
            $query .= ' ' . implode(' ', $this->joins);
        }

        if (!is_null($this->where)) {
            $query .= ' ' . $this->where;
        }

        if (!is_null($this->groupBy)) {
            $query .= ' ' . $this->groupBy;
        }

        if (!is_null($this->having)) {
            $query .= ' ' . $this->having;
        }

        if (!is_null($this->orderBy)) {
            $query .= ' ' . $this->orderBy;
        }   

        if (!is_null($this->limit)) {
            $query .= ' ' . $this->limit;
        } else {
            if (!is_null($option)) {
                $query .= ' LIMIT ' . $option;
            }
        }

        $query .= ";";
        
        return $query;
    }

    /**
     * @return string query
     */
    public function buildInsert()
    {
        $query = "INSERT INTO ";

        $query .= '`'.$this->table.'`';

        $query .= " " . $this->insert;

        if (!is_null($this->where)) {
            $query .=" ".$this->where;
        }

        $query .= ";";

        return $query;
    }

    /**
     * @return string query
     */
    public function buildUpdate()
    {
        $query = "UPDATE ";

        $query .= '`'.$this->table . "` SET";
        
        $query .=" ".$this->update;

        if (!is_null($this->where)) {
            $query .=" ".$this->where;
        }

        $query .= ";";

        return $query;
    }

    /**
     * @return string query
     */
    public function buildDelete()
    {
        $query = "DELETE FROM ";

        $query .= $this->table;

        if (!is_null($this->where)) {
            $query .=" ".$this->where;
        }

        if (!is_null($this->resetIncrement)) {
            $query .= "; ALTER TABLE " . $this->table . " AUTO_INCREMENT = 1;";
        }

        $query .= ";";

        return $query;
    }

    public function buildResetIncrement()
    {
        $query = "ALTER TABLE " . $this->table . " AUTO_INCREMENT = 1;";

        return $query;
    }
}
