<?php

namespace Core;


class QueryBuilder
{
    private string $table;
    private array $where;
    private array $orWhere;

    private array $bindings;
    public function __construct(string $table, array $where = [], array $orWhere = [], array $bindings = [])
    {
        $this->table = $table;
        $this->where = $where;
        $this->orWhere = $orWhere;
        $this->bindings = $bindings;
    }

    /**
     * Query builder methods
     *
     * /

    /**
     * Get required data by statement
     *
     */
    public function get()
    {
        $query = "SELECT * FROM {$this->table}";

        $query = $this->createRequest($query);

        $stmt = (new Database())->connect()->prepare($query);

        foreach ($this->bindings as $key => $value) {
            $stmt->bindParam(":$key", $value);
        }

        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    /**
     * Get first row from query result
     */
    public function first()
    {
        $query = "SELECT * FROM {$this->table}";

        $query = $this->createRequest($query);

        $stmt = (new Database())->connect()->prepare($query);

        foreach ($this->bindings as $key => $value) {
            $stmt->bindParam(":$key", $value);
        }

        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }

    /**
     * Get by id
     */
    public function find(int $id)
    {
        $query = "SELECT * FROM {$this->table} WHERE `id` = :id";


        $stmt = (new Database())->connect()->prepare($query);
        $stmt->bindParam(":id", $id);

        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }

    /**
     * Where statement
     */
    public function where(string $field, string $operator, string $value)
    {
        $param = 'param_' . count($this->bindings);
        $this->where[] = "$field $operator :$param";
        $this->bindings[$param] = $value;
        return $this;
    }

    /**
     * Or where statement
     */
    public function orWhere(string $field, string $operator, string $value)
    {
        $param = 'param_' . count($this->bindings);
        $this->orWhere[] = "$field $operator :$param";
        $this->bindings[$param] = $value;
        return $this;
    }

    /*
     * QueryBuilder helper functions
     *
     */

    /*
     * Combine all query request in one query
     *
     */
    private function createRequest(string $query)
    {
        $query .= $this->setWhereStatements($query);
        $query .= $this->setOrWhereStatements($query);

        return $query;
    }

    /*
     * Insert where statements in query
     */
    private function setWhereStatements(string $query)
    {
        if(!empty($this->where)) {
            if(str_contains($query, 'WHERE')) {
                return implode(' AND ', $this->where);
            }
            return ' WHERE ' . implode(' AND ', $this->where);
        }
        return '';
    }

    /*
     * Insert or where statements in query
    */
    private function setOrWhereStatements(string $query)
    {
        if(!empty($this->orWhere)) {
            if(str_contains($query, 'WHERE')) {
                return ' OR '. implode(' OR ', $this->orWhere);
            } else {
                return ' WHERE ' . implode(' OR ', $this->where);
            }
        }
        return '';
    }
}