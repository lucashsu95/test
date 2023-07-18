<?php
include '../link.php';
$admin = $_SESSION['admin'];
$sql = $db->prepare("update {$admin['name']} set processing=:processing where id=:id");
$sql->bindValue('id', $_POST['id']);
$sql->bindValue('processing', $_POST['processing']);
$sql->execute();
header("location:./repairList.php?type={$admin['name']}");
