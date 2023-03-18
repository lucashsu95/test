<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.47/vue.global.js' integrity='sha512-2zwx0mkoR2cxZY0humPK79YhJYgoX5lT+WNqkgTcV7qhVm3+msjlmOgoXnN1cW2r9qqbZez3XhnLZsyW3k8Wtg==' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php
    include '../link.php';
    include '../nav.php';
    $sql = 'select * from product';
    $query = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <div class='control-box'>
        <p>
            <a href="./addproduct.html">新增商品</a>
        </p>
        <p>
            <a href="./addtemplate.html">新增模版</a>
        </p>
    </div>

    <div id='app'>
        <div class='layouts' style='width: 100%;'>
            <div v-for='product,i in productAry' class='layout'>
                <template v-for='id,j in layout_id'>
                    <template v-if='id == product["template_id"]'>
                        <a :href="'modify.php?id=' + product['id']">修改</a>
                        <a :href="'destroy.php?id=' + product['id']">刪除</a>
                        <div v-for='key,keyIndex in layouts[j]' :class='key' v-html='preview(key,i)' ></div>
                    </template>
                </template>
            </div>
        </div>
    </div>

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
                    fetch("getlayouts.php")
                    .then((res) => res.json())
                    .then((json) => {
                        this.layouts = json.map((x) => JSON.parse(x["layout"]));
                        this.layout_id = json.map((x) => x['id']);
                    });
                },
                preview(key,i) {
                    if (key === "image") {
                    return `<img src='../${this.productAry[i][key]}'>`;
                    }
                    return this.productAry[i][key];
                },
            }
        }).mount('#app');
    </script>
</body>
</html>