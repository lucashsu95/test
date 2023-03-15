<?php

include '../link.php';
$db->query('update timeCount set time=' . $_GET['timeCount']);
header('location:user.php');