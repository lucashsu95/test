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
        $sql = 'select * from active where 1=1';
        $hasKeywords = $_GET['key'] ?? false;
        $hasDateStart = $_GET['dateStart'] ?? false;
        $hasDateEnd = $_GET['dateEnd'] ?? false;

        if ($hasKeywords) {
            $sql .= " and (name like '%{$_GET['key']}%' or udesc like '%{$_GET['key']}%' or link like '%{$_GET['key']}%')";
        }
        if($hasDateStart){
            $sql .= " and date>'{$_GET['dateStart']}'";
        }
        if($hasDateEnd){
            $sql .= " and date<'{$_GET['dateEnd']}'";
        }
        $sql .= ' and isShow=0';
        $sql .= ' order by isTop desc ,date desc';
        

        $activeAry = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $templateAry = $db->query('select * from template')->fetchAll();
        $templates = [];
        $templates_id = [];

        for($i = 0;$i < count($templateAry) ; $i++){
            array_push($templates,json_decode($templateAry[$i]['template']));
            array_push($templates_id,json_decode($templateAry[$i]['id']));
        }
        ?>
        <form>
            <input type="text" name="key" placeholder='請輸入關鍵字' v-model='key'>
            <br>
            <input type="date" name="dateStart">
            ~
            <input type="date" name="dateEnd">
            <button class='btn'>查詢</button>
        </form>

        <div class='layouts'>
            <template v-for='active,i in activeAry' >
                <template v-for='id,j in template_id'>
                    <template v-if="active['template_id'] == id">
                        <div class='layout'>
                            <div v-for='key in templates[j]' :class='key' v-html='preview(key,i)'></div>
                        </div>
                    </template>
                </template>
            </template>
        </div>

<?php
    }else{
        header('location:login.html');
        } ?>
</div>
    <script>
        const app = Vue.createApp({
            data(){
                return{
                    activeAry: JSON.parse('<?php echo json_encode($activeAry); ?>'),
                    templates: JSON.parse('<?php echo json_encode($templates); ?>'),
                    template_id: JSON.parse('<?php echo json_encode($templates_id); ?>'),
                    key:'',
                }
            },
            methods:{
                preview(key,keyIndex) {
                    if (key === "image") {
                        return `<img src=${this.activeAry[keyIndex][key]} alt="img">`;
                    } else if(key === 'udesc' && this.activeAry[keyIndex][key].length > 10) {
                        return `${this.activeAry[keyIndex][key].substr(1,9)}<button onclick='showMore(${keyIndex},"${this.activeAry[keyIndex][key]}")'>more...</button>`;
                    } else if (key === "signUp") {
                        return `<a href='./gaming/signUp.php?id=${this.activeAry[keyIndex]['id']}'>報名</a>`;
                    } else {
                        return this.activeAry[keyIndex][key];
                    }
                },
                keyword(){
                    location.href = './?q=' + this.key;
                }
            }
        }).mount('#app');


        function showMore(keyIndex,x){
            let udesc = document.querySelectorAll(`.udesc`);
            udesc[keyIndex].innerText = x
        }
    </script>

</body>
</html>