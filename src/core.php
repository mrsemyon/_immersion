<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/createPDO.php';

include $_SERVER['DOCUMENT_ROOT'] . '/src/getUserByEmail.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/getUsersList.php';

include $_SERVER['DOCUMENT_ROOT'] . '/src/addUser.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/checkPassword.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/prepareUserPhoto.php';

include $_SERVER['DOCUMENT_ROOT'] . '/src/redirect.php';

include $_SERVER['DOCUMENT_ROOT'] . '/src/displayFlashMessage.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/setFlashMessage.php';

include $_SERVER['DOCUMENT_ROOT'] . '/src/setUserInfo.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/setUserPhoto.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/setUserSocialLinks.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/setUserStatus.php';
