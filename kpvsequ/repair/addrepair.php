<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body class='flex-column'>
    <?php
    $type = $_GET['type'] ?? 'learn';
    ?>
    <a href="../index.php" target="_top" class="btn btn-dark mb-3">回首頁</a>
    <form action="./addrepairprocess.php" method="post" style="max-width: 800px;" class="container p-0 shadow-lg border border-white p-4 rounded-4">
        <h1>新增報修</h1>
        <hr>
        <?php if ($type === 'school') { ?>
            <section class="form-floating">
                <input class="form-control" type="text" name="class" id='class' placeholder='例如：黑板、桌子、窗戶…' required>
                <label for="class">損壞設備</label>
            </section>
        <?php } else if ($type === 'learn') { ?>
            <div class="form-text mt-4 ms-1">損壞設備</div>
            <select name="class" class="form-select" required>
                <option value='' selected disabled>請選擇</option>
                <option value="電視">電視</option>
                <option value="音箱">音箱</option>
                <option value="麥克風">麥克風</option>
                <option value="電腦設備">電腦設備</option>
                <option value="投影機">投影機</option>
                <option value="布幕">布幕</option>
            </select>
        <?php } ?>

        <section class="form-floating my-3">
            <input class="form-control" type="text" name="repair_name" id='repair_name' placeholder='填報人姓名' maxlength='15' required>
            <label for="repair_name">填報人姓名</label>
        </section>

        <section class="form-floating my-3">
            <input class="form-control" type="text" name="  repair_place" id='    repair_place' placeholder='教室編號 / 損壞地點' maxlength='15' required>
            <label for="    repair_place">教室編號 / 損壞地點</label>
            <div class="form-text ms-2">例如:231教室、電3..</div>
        </section>

        <section class="form-floating my-3">
            <textarea class="form-control" name="situation" id="situation" placeholder="狀況概述" style="height: 100px"></textarea></textarea>
            <label for="situation">狀況概述</label>
        </section>

        <section class="row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-primary">送出申請</button>
                <button type="reset" class="btn btn-secondary">重填</button>
            </div>
        </section>
        <input type="hidden" name="type" value='<?php echo $type ?>'>
    </form>
</body>

</html>