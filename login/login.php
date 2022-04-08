<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$email = $_POST['email'];
$password = $_POST['password'];

$data = $db->read('users', ['email' => $email]);

if (! empty($data)) {
    if (checkPassword($password, $data['password'])) {
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $data['role'];
        $_SESSION['id'] = $data['id'];
        setFlashMessage('success', 'Авторизация прошла успешно.');
        redirect("/");
        exit;
    }
}

setFlashMessage('danger', '<strong>Уведомление!</strong> Неверно введен логин или пароль.');
redirect("/login/");
exit;
