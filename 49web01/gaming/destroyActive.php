<?php
include '../link.php';
$db->query('delete from active where id=' . $_GET['id']);
header('location:manage.php');