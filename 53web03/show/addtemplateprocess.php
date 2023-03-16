<?php
include '../link.php';
$sql = $db->prepare('insert into product(name,udesc,price,link,image,date,template_id) values(:name,:udesc,:price,:link,:image,:date,:template_id)');

$fileName = date('YmdHis');
$path = "../image/$fileName.jpg";
move_uploaded_file($_FILES['image']['tmp_name'],$path);
$path = "image/$fileName.jpg";

$template_id = $db->query('select * from template limit 1 offset ' . $_POST['template_id']);

$sql->bindValue('name',$_POST['name']);
$sql->bindValue('udesc',$_POST['udesc']);
$sql->bindValue('price',$_POST['price']);
$sql->bindValue('link',$_POST['link']);
$sql->bindValue('date',$_POST['date']);
$sql->bindValue('image',$path);
$sql->bindValue('template_id',$template_id);
$sql->execute();
header('location:show.php');
