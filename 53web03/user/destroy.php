<?php
include '../link.php';
$db->query('delete from users where id=' . $_GET['id']);
header('location:user.php');