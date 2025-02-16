<?php

namespace Core;

class Database
{
    protected \PDO $db;
    private string $server;
    private string $dbName;
    private string $username;
    private string $password;

    public function __construct()
    {
        $this->server = $_ENV['DB_SERVER'];
        $this->dbName = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
    }

    public function connect(): \PDO
    {
        try {
            $this->db = new \PDO("mysql:host=$this->server;dbname=$this->dbName", $this->username, $this->password);
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            echo "Connection failed: " . $exception->getMessage();
        }
        return $this->db;
    }

    // Query builder
    public static function table(string $table)
    {
        return new QueryBuilder($table);
    }
}