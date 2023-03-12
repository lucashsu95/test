<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員管理</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php 
    include '../link.php';
    include '../nav.php';
    $sql = 'select * from users where 1=1';
    
    @$key = $_GET['key'];
    @$order = $_GET['order'];
    if($key <> ''){
        $sql .= " and account like '%$key%'";
    }
    if($order){
        $sql .= " order by $order " . $_GET['isAsc'];
    }
    $query = $db->query($sql)->fetchAll();
    ?>
    <section class='timeOutBox'>
        <h1>是否還繼續操作?</h1>
        <br><br>
        <p><button class="btn" onclick='fs_close()'>yes</button>
        <button class="btn" onclick='location.href="../logout.php"'>no</button></p>
    </section>

    <form action="user.php" method="get">
        <button class="btn"><a href="./userMod.php">新增使用者</a></button>
        <button class="btn"><a href="./viewrecord.php">登入登出記錄</a></button>
        <br><br>
        <input type="text" class='time' value='60'><button class="btn">重新計時</button>
        <br><br>

        <input type="text" name="key" placeholder='請輸入關鍵字'>
        <br>
        <select name="order">
            <option value="id">使用者編號</option>
            <option value="name">姓名</option>
            <option value="account">帳號</option>
        </select>
        <select name="isAsc">
            <option value="asc">遞增</option>
            <option value="desc">遞減</option>
        </select>
        <button type='submit' class="btn">查詢</button>

    </form>
    <div class='userContainer'>
        <div>
            <div>ID</div>
            <div>姓名</div>
            <div>帳號</div>
            <div>密碼</div>
            <div>權限</div>
            <div>操作</div>
        </div>
    <?php
    foreach($query as $data){
        ?>
        <div>
            <div><?php echo $data['user_id']?></div>
            <div><?php echo $data['name']?></div>
            <div><?php echo $data['account']?></div>
            <div><?php echo $data['password']?></div>
            <div><?php echo $data['role']?></div>
            <div>
                <?php if($data['user_id'] !== 'u0001'){?>
                <a href="userMod.php?id=<?php echo $data['id'] ?>">修改</a>
                <a href="destroy.php?id=<?php echo $data['id'] ?>">刪除</a>
                <?php } ?>
            </div>
        </div>
    <?php
    }
    ?>
    </div>
    <script>
        let count;
        let time = document.querySelector('.time');
        let timeOutBox = document.querySelector('.timeOutBox');

        function fs_count(){
            count = setTimeout(fs_timeOut, time.value * 1000);
        }
        function fs_timeOut(){
            timeOutBox.classList.add('active');
            timeOut = setTimeout(() => {
                location.href="../logout.php"
            }, 5000);
        }
        function fs_close(){
            clearTimeout(count);
            clearTimeout(timeOut);
            timeOutBox.classList.remove('active');
            fs_count()
        }
        fs_count()
    </script>
</body>
</html>