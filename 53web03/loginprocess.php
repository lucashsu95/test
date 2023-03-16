<?php
include 'link.php';
$sql = $db->prepare('select * from users where account=:account');
$sql->bindValue('account',$_POST['account']);
$sql->execute();
$query = $sql->fetch();

$_SESSION['account'] = $_POST['account'];
$_SESSION['action'] = '登入';
$_SESSION['utype'] = '失敗';

function err($key){
    $_SESSION['err']++ ;
    if($_SESSION['err'] >= 3){
        $_SESSION['err'] = 0;
        echo "<script>alert('{$key}錯誤 大於三次');location.href='record.php'</script>";
    }
    echo "<script>alert('{$key}錯誤');location.href='record.php'</script>";
}

if($_POST['ans'] != $_POST['userAns']){
    err('驗證碼');
}else if(!$query){
    err('帳號');
}else if($_POST['password'] != $query['password']){
    err('密碼');
}else{
    $_SESSION['user'] = $query;
    header('location:login2.html');
}