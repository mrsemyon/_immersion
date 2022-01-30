<?php

session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$email = $_POST['email'];
$password = $_POST['password'];

$data = getUserByEmail($pdo, $email);

if (! empty($data)) {
    if (checkPassword($pdo, $password, $data['password'])) {
        setFlashMessage('success', 'Авторизация прошла успешно.');
        $_SESSION['email'] = $email;
        redirect("/users/");
        exit;
    }
}

setFlashMessage('danger', '<strong>Уведомление!</strong> Неверно введен логин или пароль.');
redirect("/login/");
exit;
