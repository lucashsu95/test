<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.47/vue.global.js' integrity='sha512-2zwx0mkoR2cxZY0humPK79YhJYgoX5lT+WNqkgTcV7qhVm3+msjlmOgoXnN1cW2r9qqbZez3XhnLZsyW3k8Wtg==' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php
    include '../link.php';
    include '../nav.php';
    ?>
    <div id="app">
        <div class='control-pages'>
            <button v-for='value,key in pages' @click='page = value' :class="{active:page === value}" class='pages'>
                {{key}}
            </button>
        </div>
        <section v-show='page === 0' class='page'>
            <h1>選擇版型</h1>
            <div class="layouts">
                <div v-for='layout,index in layouts' :key='index' class='layout' 
                :class='{active:selectedlayout === index}'
                @click='selectedlayout = index'
                >
                    <div v-for='key,keyIndex in layout' :key='key' :class='key'>
                        {{layoutData[key]}}
                    </div>
                </div>
            </div>
        </section>
        <section v-show='page === 1' class='page'>
            <h1>填寫資料</h1>
            <label>商品名稱</label><input type="text" name="name">
            <label>商品簡介</label><input type="text" name="udesc">
            <label>圖片</label><input type="file" name="image">
            <label>費用</label><input type="text" name="price">
            <label>相關連結</label><input type="text" name="link">
        </section>
        <section v-show='page === 2' class='page'></section>
        <section v-show='page === 3' class='page'></section>
    </div>


    <script>
        const app = Vue.createApp({
            data(){
                return {
                    page:1,
                    pages:{
                        選擇版型:0,
                        填寫資料:1,
                        預覽:2,
                        確任送出:3,
                    },
                    layoutData:{
                        name:'商品名稱',
                        image:'圖片',
                        date:'日期',
                        link:'相關連結',
                        price:'費用:0000',
                        udesc:'商品簡介',
                    },
                    layouts:[
                        ['name','price','image','link','udesc','date'],
                        ['image','name','price','link','udesc','date'],
                        ['price','date','udesc','link','name','image'],

                    ],
                    selectedlayout:0,
                }
            }
        }).mount('#app');
    </script>
</body>
</html>