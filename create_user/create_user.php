<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

if ($_SESSION['role'] != 'admin') {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect('/users/');
    exit;
}

$pdo = createPDO();
$email = $_POST['email'];

if (! empty(getUserByEmail($pdo, $email))) {
    setFlashMessage('danger', '<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.');
    redirect("/create_user/");
    exit;
}

$photo = (! empty($_FILES['photo']['name']))
	? prepareUserPhoto($_FILES['photo'])
	: 'no_photo.jpg';

$id = addUser($pdo, $email, $_POST['password']);

setUserInfo( $pdo, $id, $_POST['name'], $_POST['phone'], $_POST['address'], $_POST['position']);

setUserSocialLinks($pdo, $id, $_POST['vk'], $_POST['telegram'], $_POST['instagram']);

setUserStatus($pdo, $id, $_POST['status']);

setUserPhoto($pdo, $id, $photo);

setFlashMessage('success', 'Пользователь успешно добавлен!');
redirect("/users/");
exit;
