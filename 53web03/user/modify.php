<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>新增使用者</title>
    <link rel="stylesheet" href="../style.css" />
  </head>
  <body>

    <?php

    include '../link.php';
    $query = $db->query('select * from users where id=' . $_GET['id'])->fetch();

    ?>
    <form action="./modifyprocess.php" method="post">
      <p>account:<input type="text" name="account" value='<?php echo $query['account']; ?>'/></p>
      <p>password:<input type="text" name="password" value='<?php echo $query['password']; ?>'/></p>
      <p>name:<input type="text" name="name" value='<?php echo $query['name']; ?>'/></p>
      role:
      <select name="role" id="role">
        <option value="會員">會員</option>
        <option <?php if($query['role'] === '管理員') echo 'selected'?> value="管理員">管理員</option>
      </select>
      <br />
      <button type="submit">新增</button>
      <button type="reset">重設</button>
      <input type="hidden" name="id" value="<?php echo $query['id']?>">
    </form>
  </body>
</html>
