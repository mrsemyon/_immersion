<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$data = $_POST;
$data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

if (!empty($db->read('users', ['email' => $_POST['email']]))) {
    setFlashMessage('danger', 'Этот эл. адрес уже занят другим пользователем.');
    redirect("/register/");
    exit;
}

$db->create('users', $data);

$_SESSION['email'] = $data['email'];
$_SESSION['role'] = $data['role'];

setFlashMessage('success', 'Регистрация прошла успешно.');
redirect("/");
exit;
