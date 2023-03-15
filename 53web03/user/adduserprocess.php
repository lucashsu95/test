<?php
include '../link.php';
$sql = $db->prepare('insert into users(account,password,name,role) values(:account,:password,:name,:role)');
$sql->bindValue('account',$_POST['account']);
$sql->bindValue('password',$_POST['password']);
$sql->bindValue('name',$_POST['name']);
$sql->bindValue('role',$_POST['role']);
$sql->execute();
header('location:user.php');