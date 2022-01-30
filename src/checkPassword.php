<?php

function checkPassword($pdo, $inputPassword, $dbPassword)
{
    return password_verify($inputPassword, $dbPassword);
}
