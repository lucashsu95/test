<?php
include '../link.php';
$sql = $db->query('update active set isTop=0');
$sql = 'update active set isTop=1 where id=' . $_GET['id'];
// echo $sql;
$db->query($sql);
header('location:./manage.php');