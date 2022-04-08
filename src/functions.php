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
