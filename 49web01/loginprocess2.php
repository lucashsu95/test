<?php
include './link.php';
$_SESSION['account'] = $_SESSION['tempUser']['account'];
$_SESSION['action'] = '登入';

if($_POST['login2Ans'] === 'true'){
    $_SESSION['user'] = $_SESSION['tempUser'];
    $_SESSION['utype'] = '成功';
}else{
    $_SESSION['utype'] = '失敗';
}

unset($_SESSION['tempUser']);
echo "<script>alert('{$_SESSION["utype"]}');location.href='record.php'</script>";