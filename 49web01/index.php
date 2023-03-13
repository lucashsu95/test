<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.47/vue.global.js' integrity='sha512-2zwx0mkoR2cxZY0humPK79YhJYgoX5lT+WNqkgTcV7qhVm3+msjlmOgoXnN1cW2r9qqbZez3XhnLZsyW3k8Wtg==' crossorigin='anonymous'></script>
</head>
<body>
    <div id="app">
    <?php
    include './link.php';
    if(isset($_SESSION['user'])){
        include './nav.php';
        $sql = 'select * from active';
        $hasKeywords = $_GET['key'] ?? false;
        if ($hasKeywords) {
            $sql .= " where name like '{$_GET['key']}'";
        }
        $activeAry = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $templateAry = $db->query('select * from template')->fetchAll(PDO::FETCH_ASSOC);
        $templates = [];

        for($i = 0;$i < count($templateAry) ; $i++){
            // array_push($template_id,$templateAry[$i]['id']);
            // array_push($templates,$templateAry[$i]['template']);
            array_push($templates,$templateAry[$i]['id'],json_decode($templateAry[$i]['template']));
        }
        var_dump($activeAry);
        echo '<br><br>';
        var_dump($templates);
    ?>
        <form>
            <input type="text" name="key" placeholder='請輸入關鍵字' v-model='key'>
            <button class='btn'>查詢</button>
        </form>
        <!-- {{templates}} -->
        <div class='layouts'>

            <div v-for='template in '></div>
            <!-- <div v-for='active in activeAry' class='layout'> -->
                <!-- <a :href="'./gaming/modiyfActive.php?id=' + active['id']">修改</a>
                <a href="'./gaming/destroy.php?id=' + active['id']">刪除</a>
                <a href="">置頂</a>
                <a href="">隱藏</a> -->
                <!-- <div v-for='key,keyIndex in active' v-html='preview(key,keyIndex)'></div> -->
            <!-- </div> -->
        </div>
        <?php

    }else{
        header('location:login.php');
    } ?>
</div>
    <script>
        const app = Vue.createApp({
            data(){
                return{
                    activeAry: JSON.parse('<?php echo json_encode($activeAry); ?>'),
                    templates: JSON.parse('<?php echo json_encode($templates); ?>'),
                    key:'',
                }
            },
            methods:{
                preview(key,keyIndex) {
                    if (keyIndex === "image") {
                        return `<img src=${key} alt="img">`;
                    } else {
                        return key;
                    }
                },
                keyword(){
                    location.href = './?q=' + this.key;
                }
            }
        }).mount('#app');
    </script>

</body>
</html>