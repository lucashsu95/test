<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel下載資料</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <?php
    include '../link.php';
    if (isset($_SESSION['admin'])) {
    ?>
        <form action="xls.php" method="post" style='marign:0 auto;text-align:center'>
            <a href="./" class='backBtn'>回系統首頁</a>
            <h1>Excel下載資料</h1>
            <h3>選擇日期範圍</h3>
            <p>
                <input type="date" name="dateStart" value='<?php echo date('Y-m-d') ?>'>
                ~
                <input type="date" name="dateEnd" value='<?php echo date('Y-m-d', strtotime('+1 day')) ?>'>
            </p>
            <p>
            <h3>選擇處室</h3>
            <select name="key">
                <option value="repair">設備組</option>
                <option value="genrepair">總物處</option>
            </select>
            </p>
            <input type="submit" value="下載">
        </form>


    <?php
    } else {
        header('location:./');
    }
    ?>
</body>

</html>