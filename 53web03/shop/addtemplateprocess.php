<?php
include '../link.php';
$sql = $db->prepare('insert into template(layout) values(:layout)');
$sql->bindValue("layout",$_POST['template']);
$sql->execute();
header('location:shop.php');