<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$user = $db->getOne('users', ['id' => $_POST['id']]);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect('/');
    exit;
}

setUserStatus($pdo, $user['id'], $_POST['status']);

setFlashMessage('success', 'Информация успешно обновлена.');
redirect("/");
exit;
