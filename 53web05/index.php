<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
    <script src="./vue.js"></script>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <?php
    include 'link.php';
    if(isset($_SESSION['user'])){
        ?>



    <?php
    }else{
        header('location:login.html');
    }
    ?>

</body>
</html>