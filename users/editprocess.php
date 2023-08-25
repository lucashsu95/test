<?php
include '../link.php';
$sql = $db->prepare('UPDATE `users` SET `account`=:act,`password`=:pwd,`role`=:role WHERE id=:id');

$sql->bindValue(':id', $_POST['id']);
$sql->bindValue(':act', $_POST['act']);
$sql->bindValue(':pwd', $_POST['pwd']);
$sql->bindValue(':role', $_POST['role']);
$sql->execute();

header('location:users.php');
