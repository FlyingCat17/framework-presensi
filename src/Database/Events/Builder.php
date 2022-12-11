<?php

namespace Riyu\Database\Events;

use Riyu\Database\Events\Execute;
use Riyu\Database\Utils\QueryInterface;

class Builder extends Execute implements QueryInterface
{
    /**
     * define table
     * 
     * @var string
     */
    protected $table;

    /**
     * define operator
     * 
     * @var array
     */
    protected $operator = [
        '=', '>', '<',
        '>=', '<=', '!=',
        '<>', 'AND', 'OR',
        'NOT', 'IN', 'LIKE',
        'BETWEEN',
    ];

    /**
     * define join
     * 
     * @var array
     */
    protected $optionJoin = [
        'LEFT', 'RIGHT',
        'INNER', 'OUTER',
        'FULL',
    ];

    /**
     * Set table for query
     * 
     * @param string $table
     * @return void
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * Set fillable for query
     * 
     * @param array $fillable
     * @return void
     */
    public function setFillable($fillable)
    {
        $this->fillable = $fillable;
    }

    /**
     * Arrange query insert
     * 
     * @param array $data
     * @return this
     */
    public function insert($data = array())
    {
        if (!is_null($this->fillable)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->fillable)) {
                    throw new \Exception("Fillable " . $key . " is not defined");
                }
            };
            $data = array_intersect_key($data, array_flip($this->fillable));

            if ($this->timestamp) {
                $this->insert = " (`" . implode('`, `', array_keys($data)) . "`, created_at, updated_at) VALUES (:" . implode(", :", array_keys($data)) . ", NOW(), NOW())";
            } else {
                $this->insert = " (`" . implode('`, `', array_keys($data)) . "`) VALUES (:" . implode(", :", array_keys($data)) . ")";
            }

            if ($this->options == null) {
                $this->options = $data;
            } else {
                $this->options = array_merge($data, $this->options);
            }
            return $this;
        } else {
            throw new \Exception("Fillable is not defined");
        }
    }

    /**
     * Arrange query select
     * 
     * @param array $selects
     * @return this
     */
    public function select($selects = ['*'])
    {
        $selects = is_array($selects) ? $selects : func_get_args();
        foreach ($selects as $as => $column) {
            if (is_string($as)) {
                $select[$as] = $column . ' AS ' . $as;
            } else {
                $select[] = $column;
            }
        }
        $this->selects = implode(', ', $select);
        return $this;
    }

    /**
     * Arrange query update
     * 
     * @param array $data
     * @return this
     */
    public function update($data = array())
    {
        if (!is_null($this->fillable)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->fillable)) {
                    throw new \Exception("Fillable " . $key . " is not defined");
                }
            };
            $data = array_intersect_key($data, array_flip($this->fillable));

            $this->update = implode(', ', array_map(function ($key, $value) {
                return "`".$key . "` = :" . $key;
            }, array_keys($data), array_values($data)));

            if ($this->timestamp) {
                $this->update .= ", updated_at = now()";
            }

            if ($this->options == null) {
                $this->options = $data;
            } else {
                $this->options = array_merge($data, $this->options);
            }
            return $this;
        } else {
            throw new \Exception("Fillable is not defined");
        }
    }

    /**
     * Arrange query delete
     * 
     * @param string $where
     * @param string $operator
     * @param string $value
     * @return this
     */
    public function where($where, $operator = null, $value = null)
    {
        $key = "wheres";
        if (isset($operator)) {
            if (in_array($operator, $this->operator)) {
                $this->where = "WHERE `" . $where . "` " . $operator . " :" . $key . "";
            } else {
                $this->where = "WHERE `" . $where . "` = :" . $key . "";
            }
        } else {
            $this->where = "WHERE `" . $where."`";
        }

        if (is_array($this->options) > 0) {
            if (in_array($operator, $this->operator)) {
                $this->options .= array($key => $value);
            } else {
                $this->options = array_merge(array($key => $operator), $this->options);
            }
        } else {
            if (in_array($operator, $this->operator)) {
                $this->options = array($key => $value);
            } else {
                $this->options = array($key => $operator);
            }
        }
        return $this;
    }

    /**
     * Arrange query delete
     * 
     * @param string $table
     * @param string $column1
     * @param string $column2
     * @param string $operator
     * @param string $options
     * @return this
     */
    public function join($table, $column1, $column2, $operator = null, $options = null)
    {
        if (!is_null($options)) {
            if (in_array($options, $this->optionJoin)) {
                if ($column2 == '=' && !is_null($operator)) {
                    $this->joins[] = $options . " JOIN `" . $table . "` ON " . $column1 . " = " . $operator;
                } else {
                    $this->joins[] = $options . " JOIN `" . $table . "` ON " . $column1 . " = " . $column2;
                }
            } else {
                throw new \Exception("Option join is not defined");
            }
        } else {
            if (!is_null($operator) && $column2 == '=') {
                $this->joins[] = "JOIN `" . $table . "` ON " . $column1 . " = " . $operator;
            } else {
                $this->joins[] = "JOIN `" . $table . "` ON " . $column1 . " = " . $column2;
            }
        }
        return $this;
    }

    /**
     * Function inner join
     * 
     * @param string $table
     * @param string $column1
     * @param string $column2
     * @param string $operator
     * @return this
     */
    public function innerJoin($table, $column1, $column2, $operator = null)
    {
        $this->join($table, $column1, $column2, $operator, "INNER");
        return $this;
    }

    /**
     * Function left join
     * 
     * @param string $table
     * @param string $column1
     * @param string $column2
     * @param string $operator
     * @return this
     */
    public function leftJoin($table, $column1, $column2, $operator = null)
    {
        $this->join($table, $column1, $column2, $operator, "LEFT");
        return $this;
    }

    /**
     * Function right join
     * 
     * @param string $table
     * @param string $column1
     * @param string $column2
     * @param string $operator
     * @return this
     */
    public function rightJoin($table, $column1, $column2, $operator = null)
    {
        $this->join($table, $column1, $column2, $operator, "RIGHT");
        return $this;
    }

    /**
     * Function full join
     * 
     * @param string $table
     * @param string $column1
     * @param string $column2
     * @param string $operator
     * @return this
     */
    public function fullJoin($table, $column1, $column2, $operator = null)
    {
        $this->join($table, $column1, $column2, $operator, "FULL");
        return $this;
    }

    /**
     * Function outer join
     * 
     * @param string $table
     * @param string $column1
     * @param string $column2
     * @param string $operator
     * @return this
     */
    public function outerJoin($table, $column1, $column2, $operator = null)
    {
        $this->join($table, $column1, $column2, $operator, "OUTER");
        return $this;
    }

    /**
     * Arange query order by
     * 
     * @param string $column
     * @param string $order
     * @return this
     */
    public function orderBy($column, $order)
    {
        $this->orderBy = "ORDER BY " . $column . " " . $order;
        return $this;
    }

    /**
     * Arange query group by
     * 
     * @param string $column
     * @return this
     */
    public function groupBy($column)
    {
        $this->groupBy = "GROUP BY " . $column;
        return $this;
    }

    /**
     * Arange query having
     * 
     * @param string $column
     * @param string $operator
     * @param string $value
     * @return this
     */
    public function having($column, $operator, $value)
    {
        $this->having = "HAVING " . $column . " " . $operator . " " . $value;
        return $this;
    }

    /**
     * Arange query limit
     * 
     * @param string $limit
     * @return this
     */
    public function limit($limit)
    {
        $this->limit = "LIMIT " . $limit;
        return $this;
    }

    /**
     * Arange query delete
     * 
     * @return this
     */
    public function delete()
    {
        if (!is_null($this->fillable)) {
            foreach ($this->fillable as $key => $value) {
                if (!in_array($key, $this->fillable)) {
                    throw new \Exception("Fillable " . $key . " is not defined");
                }
            };
            $this->isDelete = true;
            return $this;
        } else {
            throw new \Exception("Fillable is not defined");
        }
    }

    /**
     * Reset auto increment
     * 
     * @param array $data
     * @return \Riyu\Database\Events\Execute
     */
    public function truncate()
    {
        $this->resetIncrement = true;
        return $this->save();
    }

    /**
     * set timestamp
     * create_at and update_at
     * 
     * @param bool $value
     * @return void
     */
    public function setTimeStamp(bool $value)
    {
        if ($value) {
            $this->timestamp = true;
        } else {
            $this->timestamp = false;
        }
    }
}
