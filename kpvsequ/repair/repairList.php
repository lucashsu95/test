<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        #tog:checked+div {
            display: flex;
        }

        .page a {
            transition: 300ms;
        }
    </style>
</head>

<body>
    <?php
    include '../link.php';

    $type = $_GET['type'];
    $page = $_GET['page'] ?? 0;
    $num = $page * 10;
    $admin = $_SESSION['admin'];
    $isProcess = $_GET['isProcess'] ?? false;
    $isAdmin = isset($_SESSION['admin']) ?? false;

    $url = "repairList.php?type=$type";

    $sql = "select * from $type order by id desc limit $num,10";
    $all = $db->query("select * from $type")->fetchAll();
    $query =  $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $len = count($all);
    $noProcessingCount = array_sum(array_map(function ($d) {
        return $d['processing'] === '未處理' ? 1 : 0;
    }, $all));
    ?>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="navbar-brand ms-md-5">
            <a href="../index.php" class="nav-link" target="_top">設備報修系統</a>
        </div>
        <label for="tog" class="navbar-toggler me-3"><span class="navbar-toggler-icon"></span></label>
        <input type="checkbox" id="tog" class="d-none">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-lg-auto">
                <li class="nav-item">
                    <a href="../" class="nav-link">回首頁</a>
                </li>
                <li class="nav-item">
                    <a href="../repair/addrepair.php?type=learn" class="nav-link">教學設備報修</a>
                </li>
                <li class="nav-item">
                    <a href="../repair/addrepair.php?type=school" class="nav-link">學校設備報修</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">只顯示未報修</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container min-vh-100">

        <div class="mt-5 fw-bold fs-5">
            <div class="mb-3">未處理共計:<span class="text-danger"><?php echo $noProcessingCount ?></span></div>
            <div class="row row-cols-5 text-center">
                <div class="col">報修類別</div>
                <div class="col">填報人</div>
                <div class="col">損壞地點</div>
                <div class="col">處理進度</div>
                <div class="col">填報時間</div>
            </div>
            <hr>
            <?php

            foreach ($query as $data) {
                if (($data['processing'] === '已處理' && $isProcess) || (isset($_SESSION['admin']) && $data['processing'] === '已處理')) {
                    continue;
                }

            ?>
                <div class="container-fluid overflow-hidden border border-3 <?php echo $type === 'repair' ? 'border-info' : 'border-success' ?> my-3 rounded-4 shadow">
                    <div class="row row-cols-5 text-center pt-3">
                        <div class="col"><?php echo $data['class'] ?></div>
                        <div class="col"><?php echo $data['repair_name'] ?></div>
                        <div class="col"><?php echo $data['repair_place'] ?></div>
                        <?php if ($admin['name'] === $type) { ?>
                            <form action="setProcessing.php" method="post" id='processing<?php echo $data['id'] ?>'>
                                <select name="processing" onchange='document.getElementById("processing<?php echo $data["id"] ?>").submit()'>
                                    <option value="已處理" <?php if ($data['processing'] === '已處理') echo "selected" ?>>已處理</option>
                                    <option value="未處理" <?php if ($data['processing'] !== '已處理') echo "selected" ?>>未處理</option>
                                </select>
                                <input type="hidden" name="id" value='<?php echo $data['id'] ?>'>
                            </form>
                        <?php } else { ?>
                            <div class="col <?php echo $data['processing'] === "已處理" ? 'text-success' : 'text-danger' ?>"><?php echo $data['processing'] ?></div>
                        <?php } ?>

                        <div class='col'><?php echo $data['repair_date'] ?></div>
                    </div>
                    <div class="row m-3 border border-2 rounded-2 overflow-hidden shadow">
                        <div class="col-2 p-2 text-center bg-secondary text-white">狀況概述</div>
                        <div class="col-10 p-2 ps-3"><?php echo $data['situation'] ?></div>
                        <div class="col-2 p-2 text-center bg-secondary text-white">處理概述</div>
                        <div class="col-10 p-2 ps-3"><?php echo $data['process_content'] ?></div>
                        <div class="col-2 p-2 text-center bg-secondary text-white">處理時間</div>
                        <div class="col-10 p-2 ps-3"><?php echo $data['process_time'] ?></div>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>

        <footer class="row text-center m-5">
            <div class="row d-flex justify-content-center py-3">
                記錄第<?php echo $num + 1 . '-' . (($num + 10 > $len) ? $len : $num + 10) ?>，共<?php echo $len ?>筆
            </div>
            <div class="row page my-5">
                <?php if ($num > 0) { ?>
                    <div class="col">
                        <a class="link-offset-1 link-offset-3-hover" href="<?php echo $url . "&page=0" ?>">
                            第一頁
                        </a>
                    </div>
                    <div class="col">
                        <a class="link-offset-1 link-offset-3-hover" href="<?php echo $url . "&page=" . ($page - 1) ?>">
                            上一頁
                        </a>
                    </div>
                <?php } ?>
                <?php if ($num < $len) { ?>
                    <div class="col">
                        <a class="link-offset-1 link-offset-3-hover" href="<?php echo $url . "&page=" . ($page + 1) ?>">
                            下一頁
                        </a>
                    </div>
                    <div class="col">
                        <a class="link-offset-1 link-offset-3-hover" href="<?php echo $url . "&page=" . intval($len / 10) ?>">
                            最後一頁
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="row">
                <?php if (isset($_SESSION['admin'])) { ?>
                    <a class='col-12 link my-3' href="../login/logout.php">登出</a>
                    <a class='col-12 link' href="../exportExcel/exportExcel.php">下載電子檔</a>
                <?php } else { ?>
                    <a href="../login/login.html" class="link">登入</a>
                <?php } ?>
            </div>
        </footer>
    </div>
</body>

</html>