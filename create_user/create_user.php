<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

if ($_SESSION['role'] != 'admin') {
    setFlashMessage('danger', 'У Вас недостаточно прав');
    redirect('/users/');
    exit;
}

$pdo = createPDO();
$email = $_POST['email'];
$password = $_POST['password'];

// if (! empty(getUserByEmail($pdo, $email))) {
//     setFlashMessage('danger', '<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.');
//     redirect("/create_user/");
//     exit;
// }
?>
<pre>
    <?=var_dump($_POST)?>
</pre>
// addUser($pdo, $email, $password);

// $status = isset($_POST['status']) ?? '';
// $name = isset($_POST['name']) ?? '';
// $position = isset($_POST['position']) ?? '';
// $phone = isset($_POST['phone']) ?? '';
// $address = isset($_POST['address']) ?? '';



// editInfo($pdo, $status, $name, $position, $phone, $address);

