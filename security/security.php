<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$user = $db->read('users', $_GET);

if (($_SESSION['role'] != 'admin') && ($_SESSION['email'] != $user['email'])) {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect('/');
    exit;
}

if (empty($_POST['password']) && ($user['email'] == $_POST['email'])) {
    setFlashMessage('danger', 'Информация не была обновлена');
    redirect('/');
    exit;
}

if (! empty($_POST['email'])) {
    if ($_POST['email'] != $user['email']) {
        if (!empty($db->read('users', ['email' => $_POST['email']]))) {
            setFlashMessage('danger', 'Этот адрес уже занят другим пользователем.');
            redirect("/users/");
            exit;
        }
        $db->update('users', $_GET, ['email' => $_POST['email']]);
        if ($_SESSION['role'] != 'admin') {
            $_SESSION['email'] = $_POST['email'];
        }
    }
} else {
    setFlashMessage('danger', 'Поле с емейлом не может быть пустым.');
    redirect("/users/");
}

$data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

if (! empty($_POST['password'])) {
    $db->update('users', $_GET, $data);
}

setFlashMessage('success', 'Информация успешно обновлена.');
redirect("/users/");
exit;
