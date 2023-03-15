<?php
include '../link.php';
$db->query('update timeCount set time=' . $_GET['time']);
header('location:user.php');