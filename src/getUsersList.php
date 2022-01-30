<?php

function getUsersList($pdo)
{
    $sql = "SELECT * FROM users";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
}
