<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$user = $db->getOne('users', $_GET);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect('/');
    exit;
}

$data = $_POST;

foreach ($data as $key => $value) {
    if ($value == '') {
        $data[$key] = $user[$key];
    }
}

$db->update('users', $_GET, $data);

setFlashMessage('success', 'Информация успешно обновлена.');
redirect("/");
exit;