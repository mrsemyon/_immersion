<?php

function setUserSocialLinks(
    $pdo,
    $id,
    $vk,
    $telegram,
    $instagram
)
{
    $sql = "UPDATE users SET
        vk = :vk,
        telegram = :telegram,
        instagram = :instagram
        WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'id' => $id,
            'vk' => $vk,
            'telegram' => $telegram,
            'instagram' => $instagram,
        ]
    );
}
