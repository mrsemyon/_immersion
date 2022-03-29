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
}
