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

function checkPassword($pdo, $inputPassword, $dbPassword)
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

function displayFlashMessage($key)
{
    echo $_SESSION[$key];
    unset ($_SESSION[$key]);
}

function getUserByEmail($pdo, $email)
{
    $sql = "SELECT * FROM users WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    return $statement->fetch();
}

function getUserById($pdo, $id)
{
    $sql = "SELECT * FROM users WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
    return $statement->fetch();
}

function getUsersList($pdo)
{
    $sql = "SELECT * FROM users";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll();
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

function setFlashMessage($key, $message)
{
    $_SESSION[$key] = $message;
}

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

function setUserPhoto($pdo, $id, $photo)
{
    $sql = "UPDATE users SET
        photo = :photo
        WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'id' => $id,
            'photo' => $photo,
        ]
    );
}

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

function setUserStatus($pdo, $id, $status)
{
    $sql = "UPDATE users SET
        status = :status
        WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(
        [
            'id' => $id,
            'status' => $status,
        ]
    );
}

function deleteUser($pdo, $id)
{
    $sql = "DELETE FROM users WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute(['id' => $id]);
}
