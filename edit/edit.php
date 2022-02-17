<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
$pdo = createPDO();

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