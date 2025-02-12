<?php

namespace Core;

abstract class Model
{
    public static string $tableName;
    protected array $fillable;

    protected string $query;

    public function __construct(array $object)
    {
        if(!isset($this->tableName)) {
            throw new \Exception('Please provide table name for model');
        }
        foreach ($object as $key => $field) {
            $this->$key = $field;
        }
    }

    /*
     * Fetch all users
     *
     */
    public static function all(): array
    {
        global $db;
        $stmt = $db->connection()->prepare("SELECT * FROM " . static::$tableName);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

}