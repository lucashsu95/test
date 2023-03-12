<?php
include 'link.php';
$sql = $db->prepare('select * from users where account=:account');
$sql->bindValue('account',$_POST['account']);
$sql->execute();
$query = $sql->fetch();

$_SESSION['account'] = $_POST['account'];
$_SESSION['action'] = '登入';



function err($key){
    $_SESSION['utype'] = '失敗';
    $_SESSION['err']++;
    if($_SESSION['err'] >= 3){
        $_SESSION['err'] = 0;
        echo "<script>alert('登入失敗 {$key}錯誤 連續錯誤 3 次');location.href='record.php'</script>";
    }
    echo "<script>alert('登入失敗 {$key}錯誤');location.href='record.php'</script>";
}
if($_POST['ans'] !== $_POST['captcha']){
    err('驗證碼');
}elseif(!$query){
    err('帳號');
}elseif($query['password'] != $_POST['password']){
    err('密碼');
}else{
    $_SESSION['user'] = $query;
    $_SESSION['utype'] = '成功';
    header('location:record.php');
}