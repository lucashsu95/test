<?php
include './share.php';
$sql = 'select * from product';
$query = $db->query($sql)->fetchAll();
echo json_encode($query);