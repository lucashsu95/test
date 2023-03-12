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
        template: "",
      },
      selectlayoutIndex: 0,
    };
  },
  methods: {
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

    onSubmit() {
      this.payload.image = this.file;
      this.payload.template = JSON.stringify(this.layouts[this.selectlayoutIndex]);
      const formData = new FormData();
      for (let key in this.payload) {
        formData.append(key, this.payload[key]);
      }
      console.log(formData['name']);
      // fetch("api.php?do=insertActive", {
      //   method: "POST",
      //   body: formData,
      // }).then(() => {
      //   alert("新增成功");
      //   location.href = "./";
      // });
    },
  },
}).mount("#app");
