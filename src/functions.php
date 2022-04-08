<?php

function dd($ar)
{
    echo '<pre>';
    var_dump($ar);
    echo '</pre>';
    die;
}

function setFlashMessage($key, $message)
{
    $_SESSION[$key] = $message;
}

function displayFlashMessage($key)
{
    echo $_SESSION[$key];
    unset ($_SESSION[$key]);
}

function prepareUserPhoto($file)
{
    $photo = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
    move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $photo);
    return $photo;
}

function redirect($path)
{
    header("Location: " . $path);
}

function checkPassword($inputPassword, $dbPassword)
{
    return password_verify($inputPassword, $dbPassword);
}

function createPDO()
{
    $host = '127.0.0.1';
    $db   = 'immersion';
    $user = 'root';
    $pass = 'root';
    $charset = 'utf8';
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    return new PDO($dsn, $user, $pass, $opt);
}

function changeEmail($pdo, $id, $email)
{
    $sql = "UPDATE users SET
        email = :email
        WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'id' => $id,
            'email' => $email,
        ]
    );
}

function changePassword($pdo, $id, $password)
{
    $sql = "UPDATE users SET
        password = :password
        WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'id' => $id,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]
    );
}

function setUserSocialLinks($pdo, $id, $vk, $telegram, $instagram)
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
