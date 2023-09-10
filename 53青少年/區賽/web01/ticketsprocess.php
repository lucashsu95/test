<?php
$db = new PDO('mysql:host=localhost;dbname=test', 'root', '');

$sql = $db->prepare('INSERT INTO `tickets`(`first_name`, `last_name`, `phone`, `password`) VALUES (:First,:Last,:Phone,:Password)');
$sql->bindValue('First', $_POST['First']);
$sql->bindValue('Last', $_POST['Last']);
$sql->bindValue('Phone', $_POST['Phone']);
$sql->bindValue('Password', $_POST['Password']);

$sql->execute();
header('location:./');
