<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>首頁</h1>
    <?php
    include 'link.php';
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['role'] == '管理員') {
    ?>
            <a href="./users/users.php">會員管理</a>
    <?php
        }
        echo '<a href="./login/logout.php">登出</a>';
    } else {
        header('Location:./login/login.html');
    }
    ?>
</body>

</html>