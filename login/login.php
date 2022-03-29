<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$email = $_POST['email'];
$password = $_POST['password'];

$data = getUserByEmail($pdo, $email);

if (! empty($data)) {
    if (checkPassword($pdo, $password, $data['password'])) {
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
