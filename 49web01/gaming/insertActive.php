<?php
include './share.php';

$sql = 'select * from template limit 1 offset ' . $_POST['template_id'];
$templateAry = $db->query($sql)->fetch(PDO::FETCH_ASSOC);

$sql = $db->prepare('insert into active(name,udesc,image,link,date,signUp,template_id) values(:name,:udesc,:image,:link,:date,:signUp,:template_id)');

$fileName = date('YmdHis');
$pathOfFile = "../img/{$fileName}.jpg";
move_uploaded_file($_FILES['image']['tmp_name'],$pathOfFile);
$pathOfFile = "./img/{$fileName}.jpg";

$sql->bindValue('name',$_POST['name']);
$sql->bindValue('udesc',$_POST['udesc']);
$sql->bindValue('link',$_POST['link']);
$sql->bindValue('signUp',$_POST['signUp']);
$sql->bindValue('image',$pathOfFile);
$sql->bindValue('date',$_POST['date']);
$sql->bindValue('template_id',$templateAry['id']);
$sql->execute();