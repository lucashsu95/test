<?php
include './share.php';
$sql = 'select * from template';
$query = $db->query($sql)->fetchAll();
echo json_encode($query);