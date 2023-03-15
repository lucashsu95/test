<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include './link.php';
    if(isset($_SESSION['user'])){
        ?>
        <nav>
            <div class="nav-left"></div>
            <div class="nav-right">
                <a href="./user/user.php">會員管理</a>
                <a href="./logout.php">登出</a>
            </div>
        </nav>
        <?php
    }else{
        header('location:login.html');   
    }?>
</body>
</html>