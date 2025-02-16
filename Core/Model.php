<?php

namespace Core;

abstract class Model
{
    public static string $tableName;
    private array $fillable;
    private string $query;

    public function __construct(array $object)
    {
        if(!isset(static::$tableName)) {
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
        $stmt = (new Database())->connect()->prepare("SELECT * FROM " . static::$tableName);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

}