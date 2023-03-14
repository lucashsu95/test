<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>電腦活動管理精靈</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.47/vue.global.js' integrity='sha512-2zwx0mkoR2cxZY0humPK79YhJYgoX5lT+WNqkgTcV7qhVm3+msjlmOgoXnN1cW2r9qqbZez3XhnLZsyW3k8Wtg==' crossorigin='anonymous'></script>
</head>
<body>
    <div id="app">

    <?php
    include '../link.php';
        include '../nav.php';
        $activeAry = $db->query('select * from active')->fetchAll(PDO::FETCH_ASSOC);
        $templateAry = $db->query('select * from template')->fetchAll();
        $templates = [];
        $templates_id = [];

        for($i = 0;$i < count($templateAry) ; $i++){
            array_push($templates,json_decode($templateAry[$i]['template']));
            array_push($templates_id,json_decode($templateAry[$i]['id']));
        }
    ?>
    <h1>電腦活動管理精靈</h1>
    <p>
        <a href="./addtemplate.html">新增模版</a>
    </p>
    <p>
        <a href="./addActive.html">新增活動</a>
    </p>
        <!-- {{templates}} -->
        <div class='layouts'>
            <template v-for='active,i in activeAry' >
                <template v-for='id,j in template_id'>
                    <template v-if="active['template_id'] == id">
                        <div class='layout'>
                                <a :href="'./modifyActive.php?id=' + active['id']">修改</a><br>
                                <a :href="'./destroyActive.php?id=' + active['id']">刪除</a><br>
                                <a :href="'./setTop.php?id=' + active['id']">置頂</a><br>
                                <a :href="'./setShow.php?id=' + active['id'] + '&isShow=' + !active['isShow']">{{active['isShow'] ? '隱藏' : '顯示'}}</a><br>
                            <div v-for='key in templates[j]' :class='key' v-html='preview(key,i)'></div>
                        </div>
                    </template>
                </template>
            </template>
        </div>
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
                        return `<img src=../${this.activeAry[keyIndex][key]} alt="img">`;
                    } else if(key === 'udesc' && this.activeAry[keyIndex][key].length > 10) {
                        return `${this.activeAry[keyIndex][key].substr(1,9)}<button onclick='showMore(${keyIndex},"${this.activeAry[keyIndex][key]}")'>more...</button>`;
                    } else {
                        return this.activeAry[keyIndex][key];
                    }
                },
            }
        }).mount('#app');


        function showMore(keyIndex,x){
            let udesc = document.querySelectorAll(`.udesc`);
            udesc[keyIndex].innerText = x
        }
    </script>

</body>
</html>