<?php
$id = $_GET['id'];
include '../link.php';
$sql = $db->query("DELETE FROM `users` WHERE id=$id");
header('location: users.php');