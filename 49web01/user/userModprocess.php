<?php
include '../link.php';
$sql = $db->prepare('insert into users(account,password,name,role,user_id) values(:account,:password,:name,:role,:user_id)');

$query = $db->query('select * from users order by id desc limit 1')->fetch();
$sql->bindValue('user_id','u' . str_pad($query['id']+1,4,'0',STR_PAD_LEFT));

if($_POST['id']){
    $sql = $db->prepare('update users set account=:account,password=:password,name=:name,role=:role where id=:id');
    $sql->bindValue('id',$_POST['id']);
}
$sql->bindValue('account',$_POST['account']);
$sql->bindValue('password',$_POST['password']);
$sql->bindValue('name',$_POST['name']);
$sql->bindValue('role',$_POST['role']);

$sql->execute();
header('location:user.php');
