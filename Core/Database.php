<?php

namespace Core;

class Database
{
    protected \PDO $db;

    private string $server;
    private string $dbName;
    private string $username;
    private string $password;

    public function __construct(string $server, string $dbName, string $username, string $password)
    {
        $this->server = $server;
        $this->dbName = $dbName;
        $this->username = $username;
        $this->password = $password;
    }

    public function connection(): \PDO
    {
        try {
            $this->db = new \PDO("mysql:host=$server;dbname=$dbName", $username, $password);
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            echo "Connection failed: " . $exception->getMessage();
        }
        return $this->db;
    }
}