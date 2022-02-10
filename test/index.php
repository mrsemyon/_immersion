<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
$pdo = createPDO();

$sql = "SELECT * FROM users LIMIT 2";
// $statement = $pdo->query($sql);
echo $pdo->exec($sql);
// $data =  $statement->fetchAll();

?><pre><?
// var_dump($data);
?></pre>