<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$user = $db->read('users', $_GET);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect("/public/users/");
    exit;
}

$data = $_POST;

foreach ($data as $key => $value) {
    if ($value == '') {
        $data[$key] = $user[$key];
    }
}

unset($data['id']);
$db->update('users', $_GET, $data);

setFlashMessage('success', 'Информация успешно обновлена.');
redirect("/public/users/");
exit;