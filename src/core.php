<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/src/functions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/classes.php';
include $_SERVER['DOCUMENT_ROOT'] . '/src/config.php';

$db = new QueryBuilder(ConnectionDB::make($config['db']));
