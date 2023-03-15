<?php
include 'link.php';
$sql = $db->prepare('select * from users where account=:account');
$sql->bindValue('account',$_POST['account']);
$sql->execute();
$query = $sql->fetch();
function err($key){
    echo "<script>alert('{$key}錯誤');location.href='record.php'</script>";
}

if(!$query){
    err('帳號');
}else{
    $_SESSION['user'] = $query;
    header('location:./');
}