<?php

include('../link.php');
$type = $_POST['type'];
if ($type === 'learn') {
    $sql = $db->prepare('insert into repair(class,repair_name,repair_place,situation,repair_date,processing) values(:class,:repair_name,:repair_place,:situation,:repair_date,:processing)');
} else {
    $sql = $db->prepare('insert into genrepair(class,repair_name,repair_place,situation,repair_date,processing) values(:class,:repair_name,:repair_place,:situation,:repair_date,:processing)');
}

$sql->bindValue('class', $_POST['class']);
$sql->bindValue('repair_name', $_POST['repair_name'] . $i);
$sql->bindValue('repair_place', $_POST['repair_place']);
$sql->bindValue('situation', $_POST['situation']);
$sql->bindValue('repair_date', $date);
$sql->bindValue('processing', '未處理');
$sql->execute();

echo '<script>alert("報修成功"),location.href="../index.php"</script>';
