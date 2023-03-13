<?php
include '../link.php';
$sql = $db->prepare('insert into template(template) values(:template)');
$sql->bindValue('template',$_POST['template']);
$sql->execute();
header('location:.././');