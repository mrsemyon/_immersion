<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$user = $db->getOne('users', ['id' => $_POST['id']]);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect('/');
    exit;
}
if ($user['photo'] != 'no_photo.jpg') {
    unlink($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $user['photo']);
}

$photo = (! empty($_FILES['photo']['name']))
	? prepareUserPhoto($_FILES['photo'])
	: 'no_photo.jpg';

setUserPhoto($pdo, $user['id'], $photo);

setFlashMessage('success', 'Аватар успешно обновлён.');
redirect("/");
exit;