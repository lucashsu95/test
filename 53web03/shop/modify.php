<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.47/vue.global.js"
      integrity="sha512-2zwx0mkoR2cxZY0humPK79YhJYgoX5lT+WNqkgTcV7qhVm3+msjlmOgoXnN1cW2r9qqbZez3XhnLZsyW3k8Wtg=="
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="../style.css" />
  </head>
  <body>
        <?php
            include '../link.php';
            $query = $db->query('select * from product where id=' . $_GET['id'])->fetch();
            
        ?>
    <div id="app">
      <h1>修改商品</h1>
      <div class="control-box">
        <button
          v-for="value,key in pages"
          @click="page = value"
          :class="{active:page === value}"
          class="pages"
        >
          {{key}}
        </button>
      </div>

      <section v-show="page === 0" class="page">
        <h1>選擇版型</h1>
        <div class="layouts">
          <div
            v-for="layout,index in layouts"
            :key="index"
            class="layout"
            :class="{active:selectedlayout === index}"
            @click="selectedlayout = index"
          >
            <div v-for="key,keyIndex in layout" :key="key" :class="key">
              {{layoutData[key]}}
            </div>
          </div>
        </div>
      </section>
      <form
        action="./modifyprocess.php"
        method="post"
        enctype="multipart/form-data"
      >
        <section v-show="page === 1" class="page page2">
          <h1>填寫資料</h1>
          <label>商品名稱</label
          ><input type="text" name="name" v-model="payload.name" />
          <label>商品簡介</label
          ><input type="text" name="udesc" v-model="payload.udesc" />
          <label>圖片</label
          ><input type="file" name="image" @change="onUpload" />
          <label>費用</label
          ><input type="text" name="price" v-model="payload.price" />
          <label>相關連結</label
          ><input type="text" name="link" v-model="payload.link" />
          <input type="hidden" name="id" value='<?php echo $query['id'] ?>'>
          <input type="hidden" name="date" :value="payload.date" />
          <input type="hidden" name="template_id" :value="selectedlayout" />
        </section>

        <section v-show="page === 2" class="page">
          <h1>預覽</h1>
          <div class="layout" style="width: 500px; margin: auto">
            <div
              v-for="key in layouts[selectedlayout]"
              :class="key"
              v-html="preview(key)"
            ></div>
          </div>
        </section>

        <section v-show="page === 3" class="page">
          <h1>確任送出</h1>
          <button>送出</button>
        </section>
      </form>
    </div>
    <script>
      const app = Vue.createApp({
        data() {
          return {
            page: 0,
            pages: {
              選擇版型: 0,
              填寫資料: 1,
              預覽: 2,
              確任送出: 3,
            },
            layoutData: {
              name: "商品名稱",
              image: "圖片",
              date: "日期",
              link: "相關連結",
              price: "費用:0000",
              udesc: "商品簡介",
            },
            layouts: [
              ["name", "price", "image", "link", "udesc", "date"],
              ["image", "name", "price", "link", "udesc", "date"],
              ["price", "date", "udesc", "link", "name", "image"],
            ],
            payload: {
              name: "<?php echo $query['name'] ?>",
              image: "../<?php echo $query['image'] ?>",
              price: "<?php echo $query['price'] ?>",
              link: "<?php echo $query['link'] ?>",
              udesc: "<?php echo $query['udesc'] ?>",
              date: this.toDay(),
            },
            selectedlayout: 0,
          };
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
                json.forEach((element,i) => {
                    if(element['id'] === '<?php echo $query['template_id']; ?>'){
                        this.selectedlayout = i;
                    }
                });
          })
        },
          toDay() {
            const now = new Date();

            const year = now.getFullYear();
            const month = now.getMonth() + 1; // 注意：需要加 1
            const date = now.getDate();
            return `${year}-${month}-${date}`;
          },
          onUpload(e) {
            const file = e.target.files[0];
            this.file = file;
            const render = new FileReader();
            render.readAsDataURL(file);
            render.onload = () => {
              this.payload.image = render.result;
            };
            // console.log(file);
          },
          preview(key) {
            if (key === "image") {
              return `<img src='${this.payload[key]}'>`;
            }
            return this.payload[key];
          },
        },
      }).mount("#app");
    </script>
  </body>
</html>
