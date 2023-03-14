<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>報名專區</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <form action="#" method="post">

        <?php
        include '../link.php';
        $sql = 'select * from active where id=' . $_GET['id'];
        $query = $db->query($sql)->fetch();
        // var_dump($query);
        echo "<h1>{$query['name']}報名表單</h1>"
        ?>
    <button class='btn' onclick='alert("報名成功")'>報名</button>
</form>
</body>
</html>