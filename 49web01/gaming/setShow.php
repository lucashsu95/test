<?php
include '../link.php';
$sql = 'update active set isShow="' . $_GET['isShow'] . '" where id=' . $_GET['id'];
// echo $sql;
$db->query($sql);
header('location:./manage.php');