<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$user = $db->read('users', $_GET);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect("/public/users/");
    exit;
}

if ($user['photo'] != 'no_photo.jpg') {
    unlink($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $user['photo']);
}

$data['photo'] = (! empty($_FILES['photo']['name']))
	? prepareUserPhoto($_FILES['photo'])
	: 'no_photo.jpg';


$db->update('users', $_GET, $data);

setFlashMessage('success', 'Аватар успешно обновлён.');
redirect("/public/users/");
exit;