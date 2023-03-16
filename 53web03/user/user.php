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
    include '../nav.php';
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

    $time = $db->query('select time from timeCount where id=1')->fetch();
    ?>
    <div id="app">
    
    <form action="./user.php" method="get">
        <p>
            <a href="../">上一頁</a>
        </p>
        <p>
            <a href="./adduser.html">新增使用者</a>
        </p>
        <p>
            <input type="text" name="time" value='<?php echo $time['time'] ?>' ref='time'>
            <button type='button' @click='setTime'>重新設定</button>

        </p>
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
        <section class='timeOut' ref='timeOut'>
            <h1>是否還繼續操作?</h1>
            <button @click='fs_timeClose'>YES</button>
            <button @click="location.href='../logout.php'">NO</button>
        </section>
    </div>

    <script>
        const app = Vue.createApp({
            data(){
                return{
                    users:<?php echo json_encode($users) ?>,
                    timeCount:null,
                    timeOut:null,

                }
            },
            mounted(){
                this.fs_timeCount();
            },
            methods:{
                fs_timeCount(){
                    console.log('fs_timeCount');
                    const time = this.$refs.time;
                    this.timeCount = setTimeout(() => {
                        // console.log('timeOut!')
                        this.$refs.timeOut.classList.add('active');
                        this.fs_timeOut();
                    }, time.value * 1000)
                },

                fs_timeOut(){
                    console.log('fs_timeOut');
                    this.timeOut = setTimeout(() => {
                        location.href='../logout.php';
                    }, 5000);
                },

                fs_timeClose(){
                    this.$refs.timeOut.classList.remove('active');
                    console.log('fs_timeClose');
                    clearTimeout(this.timeCount);
                    clearTimeout(this.timeOut);
                    this.fs_timeCount();
                },

                setTime(){
                    const time = this.$refs.time;
                    location.href = 'setTime.php?time=' + time.value;
                }
            }
            
        }).mount('#app');
    </script>
</body>
</html>