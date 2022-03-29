<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$user = getUserById($pdo, $_POST['id']);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect('/users/');
    exit;
}

$data = $_POST;

foreach ($data as $key => $value) {
    if ($value == '') {
        $data[$key] = $user[$key];
    }
}

setUserInfo(
    $pdo,
    $data['id'],
    $data['name'],
    $data['phone'],
    $data['address'],
    $data['position']
);

setFlashMessage('success', 'Информация успешно обновлена.');
redirect("/users/");
exit;