<?php
include '../link.php';
$db->query('delete from product where id=' . $_GET['id']);
header('location:shop.php');