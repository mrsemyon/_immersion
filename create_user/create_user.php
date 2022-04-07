<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

if ($_SESSION['role'] != 'admin') {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect('/');
    exit;
}

$pdo = createPDO();
$data = $_POST;
$data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

if (!empty($db->getOne('users', ['email' => $_POST['email']]))) {
    setFlashMessage('danger', 'Этот эл. адрес уже занят другим пользователем.');
    redirect("/create_user/");
    exit;
}

$photo = (! empty($_FILES['photo']['name']))
	? prepareUserPhoto($_FILES['photo'])
	: 'no_photo.jpg';

$id = $db->insert('users', $data);

setUserInfo( $pdo, $id, $_POST['name'], $_POST['phone'], $_POST['address'], $_POST['position']);

setUserSocialLinks($pdo, $id, $_POST['vk'], $_POST['telegram'], $_POST['instagram']);

setUserStatus($pdo, $id, $_POST['status']);

setUserPhoto($pdo, $id, $photo);

setFlashMessage('success', 'Пользователь успешно добавлен!');
redirect("/");
exit;
