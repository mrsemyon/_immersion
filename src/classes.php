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
    function getAll($table)
    {
        $sql = "SELECT * FROM $table";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    function getOne($table, $field)
    {
        $sql = "SELECT * FROM $table WHERE ";
        foreach ($field as $key => $value) {
            $sql .= $key . '=:' . $key . ' AND ';
        }
        $sql = rtrim($sql, ' AND ') . ';';
        $statement = $this->pdo->prepare($sql);
        $statement->execute($field);
        return $statement->fetch();
    }
    function insert($table, $data)
    {
        $keys = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($keys) VALUES ($values)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        return $this->pdo->lastInsertId();
    }
}
