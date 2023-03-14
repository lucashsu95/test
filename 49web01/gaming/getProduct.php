<?php
include '../link.php';
$sql = 'select * from product';
$query = $db->query($sql)->fetchAll();
echo json_encode($query);