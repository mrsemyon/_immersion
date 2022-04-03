<?php

class ConnectionDB
{
    public static function make($config)
    {
        return new PDO(
            "mysql:host={$config['host']};dbname={$config['name']};charset={$config['charset']}",
            $config['user'], $config['password'], $config['opt']);
    }
}

class QueryBuilder
{
    protected $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    function getUsersList()
    {
        $sql = "SELECT * FROM users";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    function set($table, $data)
    {
        $keys = implode(', ', array_keys($data));
        $tags = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($keys) VALUES ($tags)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        return $this->pdo->lastInsertId();
    }
}
