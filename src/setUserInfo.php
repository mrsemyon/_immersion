<?php

function setUserInfo(
    $pdo,
    $id,
    $name,
    $phone,
    $address,
    $position
)
{
    $sql = "UPDATE users SET
        name = :name,
        phone = :phone,
        address = :address,
        position = :position
        WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'id' => $id,
            'name' => $name,
            'phone' => $phone,
            'address' => $address,
            'position' => $position,
        ]
    );
}
