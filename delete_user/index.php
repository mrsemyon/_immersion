<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$user = getUserById($pdo, $_GET['id']);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect('/');
    exit;
}

deleteUser($pdo, $_GET['id']);

if ($user['photo'] != 'no_photo.jpg') {
    unlink($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $user['photo']);
}

setFlashMessage('success', 'Пользователь успешно удалён');

if ($user['email'] == $_SESSION['email']) {
    session_destroy();
    redirect('/login/');
}

redirect('/');
