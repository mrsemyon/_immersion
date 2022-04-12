<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

echo '<pre>';
var_dump($_SERVER["REQUEST_URI"]);
var_dump($_SERVER["SCRIPT_NAME"]);
echo '</pre>';
