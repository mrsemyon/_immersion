<?php

function addUser($pdo, $email, $password)
{
    $sql = "INSERT INTO users (email, password, role)
        VALUES (:email, :password, :role)";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'user',
        ]
    );
    return $pdo->lastInsertId();
}
