<?php

function prepareUserPhoto($file)
{
    $photo = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
    move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/assets/img/demo/avatars/' . $photo);
    return $photo;
}
