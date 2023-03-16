<?php
$_SESSION['account'] = $_SESSION['userTemp'];
$_SESSION['action'] = '登入';

if($_POST['ans'] === 'true'){

    $_SESSION['utype'] = '成功';
    $_SESSION['user'] = $_SESSION['userTemp'];

}else{

    $_SESSION['utype'] = '失敗';
    echo "<script>alert('失敗');location.href='record.php'</script>";

}

unset($_SESSION['userTemp']);
header('location:record.php');