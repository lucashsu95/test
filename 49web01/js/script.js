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
        name: "",
        udesc: "",
        date: "",
        image: "",
        link: "",
        signUp: "",
        template_id: "",
      },
      dragIndex: "",
      dragKey: "",
      selectlayoutIndex: 0,
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
          console.log(this.layouts);
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

        fetch("addActiveprocess.php", {
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
