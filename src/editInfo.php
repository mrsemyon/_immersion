<?php

function editInfo($pdo, $status, $name, $position, $phone, $address)
{
    $sql = "INSERT INTO users (status, name, position, phone, address) 
        VALUES (:status, :name, :position, :phone, :address)";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'status' => $status,
            'name' => $name,
            'position' => $position,
            'phone' => $phone,
            'address' => $address,
        ]
    );
}
