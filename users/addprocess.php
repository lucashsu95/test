<?php

include '../link.php';

$sql = $db->prepare("INSERT INTO users(account, password, role) VALUES (:act,:pwd,:role)");
$sql->bindValue(':act', $_POST['act']);
$sql->bindValue(':pwd', $_POST['pwd']);
$sql->bindValue(':role', $_POST['role']);
$sql->execute();

header('location:users.php');
