<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$pdo = createPDO();
$user = getUserById($pdo, $_POST['id']);

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
        if (!empty($db->getOne('users', ['email' => $_POST['email']]))) {
            setFlashMessage('danger', 'Этот адрес уже занят другим пользователем.');
            redirect("/");
            exit;
        }
        changeEmail($pdo, $user['id'], $_POST['email']);
        if ($_SESSION['role'] != 'admin') {
            $_SESSION['email'] = $_POST['email'];
        }
    }
}

if (! empty($_POST['password'])) {
    changePassword($pdo, $user['id'], $_POST['password']);
}

setFlashMessage('success', 'Информация успешно обновлена.');
redirect("/");
exit;