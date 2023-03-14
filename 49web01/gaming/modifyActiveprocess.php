<?php
include '../link.php';

$sql = 'select * from template limit 1 offset ' . $_POST['template_id'];
$templateAry = $db->query($sql)->fetch();

if($_FILES['image']['tmp_name']){

  $fileName = date('YmdHis');
  $pathOfFile = "../img/{$fileName}.jpg";
  move_uploaded_file($_FILES['image']['tmp_name'],$pathOfFile);
  $pathOfFile = "img/{$fileName}.jpg";

  $sql = $db->prepare('update active set image=:image where id=:id');
  $sql->bindValue('id',$_POST['id']);
  $sql->bindValue('image',$pathOfFile);
  $sql->execute();

} 

$sql = $db->prepare('update active set name=:name,udesc=:udesc,link=:link,date=:date,signUp=:signUp,template_id=:template_id where id=:id');
$sql->bindValue('id',$_POST['id']);
$sql->bindValue('name',$_POST['name']);
$sql->bindValue('udesc',$_POST['udesc']);
$sql->bindValue('link',$_POST['link']);
$sql->bindValue('signUp',$_POST['signUp']);
$sql->bindValue('date',$_POST['date']);
$sql->bindValue('template_id',$templateAry['id']);
$sql->execute();