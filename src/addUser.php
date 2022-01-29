<?php

function addUser($pdo, $email, $password)
{
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);
}
