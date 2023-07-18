<?php
include('../link.php');
$sql = $db->prepare('select * from users where account=:account and password=:password');
$sql->bindValue('account', $_POST['account']);
$sql->bindValue('password', $_POST['password']);
$sql->execute();
$query = $sql->fetch();

if ($query) {
    $_SESSION['admin'] = $query;
    header("location:../repair/repairList.php?type={$query['name']}");
} else {
    echo '<script>alert("帳密錯誤");location.href="login.html"</script>';
};
