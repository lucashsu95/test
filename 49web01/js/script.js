const app = Vue.createApp({
  data() {
    return {
      grids: [],
      userIndex: [],
      userValue: [],
      gridOver: [],

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
    this.setGrid();
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
    allToggle() {
      grids = document.querySelectorAll(".grid>div");
      grids.forEach((element) => {
        element.classList.toggle("active");
      });
    },

    setGrid() {
      let ary = [];

      while (ary.length < 3) {
        let num = this.az[Math.floor(Math.random() * this.az.length)];
        if (!ary.includes(num)) {
          ary.push(num);
        }
      }
      this.grids = ["E", "E", ...ary, ...ary];
      // this.grids.sort();
      this.grids.sort(() => 0.5 - Math.random());
    },

    gridMod(e) {
      e.target.classList.add("active");

      if (!this.gridOver.includes(e.target.dataset.index)) {
        this.userIndex.push(e.target.dataset.index);
        this.userValue.push(e.target.dataset.value);
      }

      console.log(this.userIndex);
      console.log(this.userValue);

      if (this.userValue.length >= 2) {
        if (this.userValue[0] !== this.userValue[1]) {
          setTimeout(() => {
            for (let i = 0; i < 2; i++) {
              let div = document.querySelector(
                `.grid>div[data-index='${this.userIndex[i]}']`
              );
              div.classList.remove("active");
            }
            this.userIndex = [];
            this.userValue = [];
          }, 30);
        } else {
          this.gridOver.push(...this.userValue);
          this.userIndex = [];
          this.userValue = [];
        }
      }
    },

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
      } else {
        return `<div>${this.payload[key]}</div>`;
      }
    },

    login() {
      if (this.gridOver.length === 8 || this.gridOver.includes("E")) {
        alert("yes");
      } else {
        alert("no");
      }
    },

    onSubmit() {
      this.payload.image = this.file;
      this.payload.template_id = this.selectlayoutIndex;
      
      const formData = new FormData();
      for (let key in this.payload) {
        console.log(key, this.payload[key]);
        formData.append(key, this.payload[key]);
      }

      fetch("insertActive.php", {
        method: "POST",
        body: formData,
      }).then(() => {
        alert("新增成功");
        location.href = ".././";
      });
    },
  },
}).mount("#app");
