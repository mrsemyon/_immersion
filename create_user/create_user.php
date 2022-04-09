<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

if ($_SESSION['role'] != 'admin') {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect('/');
    exit;
}

$data = $_POST;
$data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

if (!empty($db->read('users', ['email' => $_POST['email']]))) {
    setFlashMessage('danger', 'Этот эл. адрес уже занят другим пользователем.');
    redirect("/create_user/");
    exit;
}

$data['photo'] = (! empty($_FILES['photo']['name']))
	? prepareUserPhoto($_FILES['photo'])
	: 'no_photo.jpg';

$db->create('users', $data);

setFlashMessage('success', 'Пользователь успешно добавлен!');
redirect("/users/");
exit;
