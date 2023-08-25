<?php

include '../link.php';

$sql = $db->prepare("SELECT * FROM `users` WHERE account=:act and password=:pwd");
$sql->bindValue(':act', $_POST['act']);
$sql->bindValue(':pwd', $_POST['pwd']);
$sql->execute();
$query = $sql->fetch();

if ($query) {
    echo '<script>alert("登入成功")</script>';
    $_SESSION['user'] = $query;
} else {
    echo '<script>alert("登入失敗")</script>';
}

echo '<script>location.href="../"</script>';