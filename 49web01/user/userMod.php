<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增使用者</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php 
        include '../link.php';
        if(@$_GET['id']){
            $query = $db->query('select * from users where id=' . $_GET['id'])->fetch();
        }
        $account = $query['account'] ?? '';
        $password = $query['password'] ?? '';
        $name = $query['name'] ?? '';
        $role = $query['role'] ?? '';
        $id = $query['id'] ?? '';

        
    ?>
    
    <form action="userModprocess.php" method="post">
        <h1><?php echo @$_GET['id'] ? '修改' : '新增' ?>使用者</h1>
        <p>
            account：<input type="text" name="account" value='<?php echo $account ?>'>
        </p>
        <p>
            password：<input type="text" name="password" value='<?php echo $password ?>'>
        </p>
        <p>
            name：<input type="text" name="name" value='<?php echo $name ?>'>
        </p>
        <p>
            <select name="role" id="role">
                <option value="會員">會員</option>
                <option <?php if($role === '管理員') echo 'selected' ?> value="管理員">管理員</option>
            </select>
        </p>
        <button type="submit" class='btn'>送出</button>
        <button type="submit" class='btn'>重設</button>
        <input type="hidden" name="id" value="<?php echo $id?>">
    </form>
</body>
</html>