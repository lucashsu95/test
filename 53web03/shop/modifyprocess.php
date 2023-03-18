<?php
include '../link.php';

if($_FILES['image']['tmp_name']){
    $fileName = date('YmdHis');
    $path = "../img/$fileName.jpg";
    move_uploaded_file($_FILES['image']['tmp_name'],$path);
    $path = "img/$fileName.jpg";
    
    $sql = $db->prepare('update product set image=:image where id=:id');
    $sql->bindValue('id',$_POST['id']);
    $sql->bindValue('image',$path);
    $sql->execute();
    
}
$sql = $db->prepare('update product set name=:name,udesc=:udesc,price=:price,link=:link,date=:date,template_id=:template_id where id=:id');

$template_id = $db->query('select * from template limit 1 offset ' . $_POST['template_id'])->fetch();

$sql->bindValue('id',$_POST['id']);
$sql->bindValue('name',$_POST['name']);
$sql->bindValue('udesc',$_POST['udesc']);
$sql->bindValue('price',$_POST['price']);
$sql->bindValue('link',$_POST['link']);
$sql->bindValue('date',$_POST['date']);
$sql->bindValue('template_id',$template_id['id']);
$sql->execute();
header('location:shop.php');
