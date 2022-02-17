<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$user = getUserById($pdo, $_POST['id']);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect('/users/');
    exit;
}

setUserInfo(
    $pdo,
    $_POST['id'],
    $_POST['name'],
    $_POST['phone'],
    $_POST['address'],
    $_POST['position']
);

setFlashMessage('success', 'Информация успешно обновлена.');
redirect("/users/");
exit;