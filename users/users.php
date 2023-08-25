<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 100%;
        }

        tr {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            padding: 1rem;
            border-bottom: 1px solid #999;
        }
    </style>
</head>

<body>
    <p>
        <a href="../">返回首頁</a>
    </p>
    <p>
        <a href="add.html">新增會員</a>
    </p>

    <?php
    include '../link.php';

    $sql = "SELECT * FROM `users`";
    $query = $db->query($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table>
        <tr>
            <td>ID</td>
            <td>帳號</td>
            <td>密碼</td>
            <td>權限</td>
            <td>操作</td>
        </tr>

        <?php
        foreach ($result as $value) {
        ?>
            <tr>
                <td><?php echo $value['id']; ?></td>
                <td><?php echo $value['account']; ?></td>
                <td><?php echo $value['password']; ?></td>
                <td><?php echo $value['role']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $value['id']; ?>">修改</a>
                    <a href="del.php?id=<?php echo $value['id']; ?>">刪除</a>
                </td>
            </tr>
        <?php
        }
        ?>

    </table>
</body>

</html>