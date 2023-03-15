<?php
include '../link.php';
$sql = $db->prepare('insert into users(account,password,name,role,rec_id) values(:account,:password,:name,:role,:rec_id)');
// var_dump($user_id);

if($_POST['id']){
    $sql = $db->prepare('update users set account=:account,password=:password,name=:name,role=:role where id=:id');
    $sql->bindValue('id',$_POST['id']);
}else{
    $sno_id = $_POST['role'] === '管理員' ? '1' : '2';
    $sql2 = "select * from sno where id=$sno_id";
    
    $sno = $db->query($sql2)->fetch();
    $rec_id = $sno['title'] . str_pad($sno['num'],4,'0',STR_PAD_LEFT);
    $sql->bindValue('rec_id',$rec_id);

    $update_sno = $db->query('update sno set num=' . $sno['num']+1 . ' where id=' . $sno_id);
}

$sql->bindValue('account',$_POST['account']);
$sql->bindValue('password',$_POST['password']);
$sql->bindValue('name',$_POST['name']);
$sql->bindValue('role',$_POST['role']);

$sql->execute();
header('location:user.php');
