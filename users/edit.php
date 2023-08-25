<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改會員</title>
</head>

<body>
    <a href="../">返回首頁</a>
    <?php
    include '../link.php';
    $id = $_GET['id'];
    $sql = "select * from users where id=$id";
    $query = $db->query($sql);
    $data = $query->fetch();
    ?>
    <form action="editprocess.php" method="post">
        <h1>修改會員</h1>
        <hr>
        <p>帳號:<input type="text" name="act" value="<?php echo $data['account'] ?>"></p>
        <p>密碼:<input type="text" name="pwd" value="<?php echo $data['password'] ?>"></p>
        <select name="role">
            <option value="會員">會員</option>
            <option <?php echo $data['role'] == '管理員' ? 'selected' : '' ?> value="管理員">管理員</option>
        </select>
        <p>
            <button type="submit">send</button>
        </p>
        <input type="hidden" name="id" value="<?php echo $id ?>">
    </form>
</body>

</html>