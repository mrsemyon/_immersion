<?php

session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
session_destroy();
redirect('/login/');
