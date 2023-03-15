<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>電腦活動製作精靈</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.47/vue.global.js"></script>
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <?php
        include '../link.php';
        $active = $db->query('select * from active where id=' . $_GET['id'])->fetch();
        $templateAry = $db->query('select * from template');
        foreach ($templateAry as $key => $template) {
            if($template['id'] === $active['template_id']){
                $selectlayoutIndex = $key;
                break;
            }
        }
        // echo $selectlayoutIndex;
    ?>
    <div id="app">
      <h1>電腦活動製作精靈</h1>
      <button
        class="btn"
        @click="page = value"
        :class="{active:page === value}"
        v-for="value,key in pages"
      >
        {{key}}
      </button>
      <section v-show="page === 0">
        <h1>選擇版型</h1>
        <div class="layouts">
          <div
            class="layout"
            v-for="layout,index in layouts"
            @click="selectlayoutIndex = index"
            :class="{active:index === selectlayoutIndex}"
          >
            <div v-for="key,keyIndex in layout">{{layoutData[key]}}</div>
          </div>
        </div>
      </section>
      <section v-show="page === 1">
        <h1>填寫資料</h1>
        <div>
          <label>電競名稱：</label
          ><input type="text" name="name" v-model="payload.name" />
        </div>
        <div>
          <label>圖片：</label
          ><input type="file" name="image" @change="onUpload" />
        </div>
        <div>
          <label>電競活動簡介：</label
          ><input type="text" name="udesc" v-model="payload.udesc" />
        </div>
        <div>
          <label>活動新聞連結：</label
          ><input type="text" name="link" v-model="payload.link" />
        </div>
        <div>
          <label>報名：</label
          ><input type="text" name="signUp" v-model="payload.signUp" />
        </div>
        <div>
          <label>競賽日期：</label
          ><input type="date" name="date" v-model="payload.date" />
        </div>
      </section>
      <section v-show="page === 2">
        <h1>預覽</h1>
        <div class="layouts">
          <div class="layout">
            <div
              v-for="key in layouts[selectlayoutIndex]"
              :class="key"
              v-html="preview(key)"
            ></div>
          </div>
        </div>
      </section>
      <section v-show="page === 3">
        <h1>確定送出</h1>
        <button class="btn" @click="onSubmit">送出</button>
      </section>
    </div>
    <script>
        const app = Vue.createApp({
        data() {
            return {
            file: "",
            page: 0,
            pages: {
                選擇版型: 0,
                填寫資料: 1,
                預覽: 2,
                確任送出: 3,
            },
            layouts: [
                ["name", "udesc", "date", "link", "image", "signUp"],
                ["image", "udesc", "date", "link", "name", "signUp"],
            ],
            layoutData: {
                name: "電競名稱",
                udesc: "電競活動簡介",
                date: "競賽日期",
                signUp: "報名",
                image: "圖片",
                link: "活動新聞連結",
            },
            payload: {
                name: "<?php echo $active['name'] ?>",
                udesc: "<?php echo $active['udesc'] ?>",
                date: "<?php echo $active['date'] ?>",
                image: "../<?php echo $active['image'] ?>",
                link: "<?php echo $active['link'] ?>",
                signUp: "<?php echo $active['signUp'] ?>",
                template_id: "<?php echo $active['template_id'] ?>",
            },
            selectlayoutIndex: <?php echo $selectlayoutIndex; ?>,
            symbol: false,
            };
        },
        mounted() {
            this.getlayouts();
        },
        computed: {
            az() {
            let ary = [];
            for (let i = 0; i < 26; i++) {
                ary.push(String.fromCharCode(i + 65));
            }
            return ary;
            },
        },

        methods: {
            getlayouts() {
            fetch("getTemplate.php", {
                method: "GET",
            })
                .then((res) => {
                return res.json();
                })
                .then((json) => {
                this.layouts = json.map((x) => JSON.parse(x.template));
                // console.log(this.layouts);
                });
            },
            
            getActive() {
            fetch("getProduct.php")
                .then((res) => {
                return res.json();
                })
                .then((json) => {
                this.layouts = json.map((x) => JSON.parse(x.template));
                console.log(this.layouts);
                });
            },

            onDragstart(e) {
            this.dragIndex = e.target.dataset.index;
            this.dragKey = e.target.dataset.key;
            },
            onDrop(e) {
            const dropIndex = e.target.dataset.index;
            const dropKey = e.target.dataset.key;

            if (this.dragIndex === dropIndex) {
                [
                this.layouts[this.dragIndex][this.dragKey],
                this.layouts[dropIndex][dropKey],
                ] = [
                this.layouts[dropIndex][dropKey],
                this.layouts[this.dragIndex][this.dragKey],
                ];
                JSON.stringify;
            }
            },
            onUpload(e) {
            const file = e.target.files[0];
            this.file = file;
            // console.log(file);
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => {
                this.payload.image = reader.result;
            };
            },

            preview(key) {
            if (key === "image") {
                return `<div><img src=${this.payload[key]} alt="img"></div>`;
            } else if (key === "udesc" && this.payload[key].length > 10) {
                return `${this.payload[key].substr(1, 9)}<button onclick='udescMore("${
                this.payload[key]
                }")'>more...</button>`;
            } else {
                return `<div>${this.payload[key]}</div>`;
            }
            },
            onSubmit() {
            if (confirm("確認是否送出?")) {
                this.payload.image = this.file;
                this.payload.template_id = this.selectlayoutIndex;

                const formData = new FormData();
                for (let key in this.payload) {
                // console.log(key, this.payload[key]);
                formData.append(key, this.payload[key]);
            }
            formData.append('id', <?php echo $_GET['id']; ?>);

                fetch("modifyActiveprocess.php", {
                method: "POST",
                body: formData,
                }).then(() => {
                alert("新增成功");
                location.href = "./manage.php";
                });
            }
            },
        },
        }).mount("#app");

        function udescMore(x) {
        document.querySelector(".udesc").innerText = x;
        // console.log(x);
        }

    </script>
  </body>
</html>
