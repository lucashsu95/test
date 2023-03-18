<?php
include '../link.php';
$query = $db->query('select * from template')->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($query);
