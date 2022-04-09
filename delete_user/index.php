<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$user = $db->read('users', $_GET);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect("/users/");
    exit;
}

$db->delete('users', $_GET);

if ($user['photo'] != 'no_photo.jpg') {
    unlink($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $user['photo']);
}

setFlashMessage('success', 'Пользователь успешно удалён');

if ($user['email'] == $_SESSION['email']) {
    session_destroy();
    redirect('/login/');
}

redirect("/users/");
