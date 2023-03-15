<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員管理</title>
    <link rel="stylesheet" href="../style.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.47/vue.global.js' integrity='sha512-2zwx0mkoR2cxZY0humPK79YhJYgoX5lT+WNqkgTcV7qhVm3+msjlmOgoXnN1cW2r9qqbZez3XhnLZsyW3k8Wtg==' crossorigin='anonymous'></script>
</head>
<body>
    <?php
    include '../link.php';
    $sql = 'select * from users where 1=1';
    $hasKey = $_GET['key'] ?? false;
    $hasOrder = $_GET['order'] ?? false;
    if($hasKey){
        $sql .= " and account like '%{$_GET['key']}%'";
    }
    if($hasOrder){
        $sql .= " order by {$_GET['order']} {$_GET['sort']}";
    }
    $users = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <p>
        <a href="../">上一頁</a>
    </p>
    <p>
        <a href="./adduser.html">新增使用者</a>
    </p>
    <form action="./user.php" method="get">
        <p>
            <input type="text" name="key" placeholder='請輸入關鍵字'>
        </p>
        <select name="order" id="order">
            <option value="id">使用者編號</option>
            <option value="account">帳號</option>
            <option value="name">姓名</option>
        </select>
        <select name="sort" id="sort">
            <option value="asc">遞增</option>
            <option value="desc">遞減</option>
        </select>
        <button type="submit">查詢</button>
        <button type="reset">重設</button>
    </form>
    <div id="app">
        <div class='users'>
            <div>使用者編號</div>
            <div>姓名</div>
            <div>帳號</div>
            <div>密碼</div>
            <div>權限</div>
            <div>操作</div>
        </div>
        <div v-for='user in users' class='users'>
            <div v-for='data in user'>
                {{data}}
            </div>
            <div v-show='user["id"] != 0000'>
                <a :href="'./modify.php?id=' + user['id']">修改</a>　
                <a :href="'./destroy.php?id=' + user['id']">刪除</a>
            </div>
        </div>
    </div>

    <section class='timeOut'>
        <h1>是否還繼續操作?</h1>
        <button>YES</button>
        <button>NO</button>
    </section>
    <script>
        const app = Vue.createApp({
            data(){
                return{
                    users:<?php echo json_encode($users) ?>,
                }
            }
        }).mount('#app');
    </script>
</body>
</html>