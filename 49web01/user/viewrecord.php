<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入登出記錄</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class='userContainer'>
        <div>
            <div>ID</div>
            <div>帳號</div>
            <div>時間</div>
            <div>動作</div>
            <div>狀態</div>
        </div>
    <?php
    include '../link.php';
    $query = $db->query('select * from record')->fetchAll();
    foreach($query as $data){
        ?>
        <div>
            <div><?php echo $data['id']?></div>
            <div><?php echo $data['account']?></div>
            <div><?php echo $data['time']?></div>
            <div><?php echo $data['action']?></div>
            <div><?php echo $data['utype']?></div>
        </div>
    <?php
    }
    ?>
    </div>
</body>
</html>