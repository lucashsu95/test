<?php
include 'link.php';
$sql = $db->prepare('insert into record(account,action,utype) values(:account,:action,:utype)');
$sql->bindValue('account',$_SESSION['account']);
$sql->bindValue('action',$_SESSION['action']);
$sql->bindValue('utype',$_SESSION['utype']);
$sql->execute();
header('location:./');
