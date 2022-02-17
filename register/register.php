<?php

session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty(getUserByEmail($pdo, $email))) {
    setFlashMessage('danger', '<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.');
    redirect("/register/");
    exit;
}

addUser($pdo, $email, $password);
$_SESSION['email'] = $email;
$_SESSION['role'] = 'user';

setFlashMessage('success', 'Регистрация прошла успешно.');
redirect("/users/");
exit;
