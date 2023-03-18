<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.47/vue.global.js' integrity='sha512-2zwx0mkoR2cxZY0humPK79YhJYgoX5lT+WNqkgTcV7qhVm3+msjlmOgoXnN1cW2r9qqbZez3XhnLZsyW3k8Wtg==' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include './link.php';
    if(isset($_SESSION['user'])){
        include './nav.php';

        $sql = 'select * from product where 1=1';
        $haskey = $_GET['key'] ?? false;
        $haspriceStart = $_GET['priceStart'] ?? false;
        $haspriceEnd = $_GET['priceEnd'] ?? false;
        if($haskey){
            $sql .= " and name like '%{$_GET['key']}%'";
        }
        if($haspriceStart){
            $sql .= " and price>={$_GET['priceStart']}";
        }
        if($haspriceEnd){
            $sql .= " and price<={$_GET['priceEnd']}";
        }
        $sql .= ' order by date';
        $query = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div id='app'>

        <form action="./" method="get">
            <input type="text" name="key" placeholder='請輸入關鍵字'>
            <br>
            <input type="text" name="priceStart" placeholder='請輸入金額'>
            ~
            <input type="text" name="priceEnd" placeholder='請輸入金額'>
            <button>查詢</button>
        </form>

        <div class='layouts' style='width: 100%;'>
            <div v-for='product,i in productAry' class='layout'>
                <template v-for='id,j in layout_id'>
                    <template v-if='id == product["template_id"]'>
                        <div v-for='key,keyIndex in layouts[j]' :class='key' v-html='preview(key,i)' ></div>
                    </template>
                </template>
            </div>
        </div>
    </div>
        <?php
    }else{
        header('location:login.html');   
    }?>
    <script>
        const app = Vue.createApp({
            data(){
                return{
                    productAry: JSON.parse('<?php echo json_encode($query); ?>'),
                    layouts:[],
                    layout_id:[],
                }
            },
            mounted() {
                this.setLayouts();
            },
            methods: {
                setLayouts() {
                    fetch("shop/getlayouts.php")
                    .then((res) => res.json())
                    .then((json) => {
                        this.layouts = json.map((x) => JSON.parse(x["layout"]));
                        this.layout_id = json.map((x) => x['id']);
                    });
                },
                preview(key,i) {
                    if (key === "image") {
                    return `<img src='${this.productAry[i][key]}'>`;
                    }
                    return this.productAry[i][key];
                },
            }
        }).mount('#app');
    </script>
</body>
</html>