<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>二次驗證</title>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.47/vue.global.js"
      integrity="sha512-2zwx0mkoR2cxZY0humPK79YhJYgoX5lT+WNqkgTcV7qhVm3+msjlmOgoXnN1cW2r9qqbZez3XhnLZsyW3k8Wtg=="
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="./css/style.css" />
  </head>
  <body>
    <div id="app">
      <form action="./loginprocess2.php" method="post">
        <div class="conatiner">
          <div class="grid">
            <div
              v-for="grid,index in grids"
              :key="index"
              :data-index="index"
              :data-value="grid"
              @click="gridMod"
            >
              {{grid}}
            </div>
          </div>

          <button class="btn" type='button' @click="allToggle">全部翻牌</button>
          <button class="btn" type='submit'>確任送出</button>
          <input type="hidden" name="login2Ans" :value='this.recordgrid.includes("E")'>
        </div>
      </form>
    </div>
    <script>
      const app = Vue.createApp({
        data() {
          return {
            grids: [],
            userIndex: [],
            userValue: [],
            recordgrid: [],
          };
        },
        mounted() {
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

            if (!this.recordgrid.includes(e.target.dataset.index)) {
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
                this.recordgrid.push(...this.userValue);
                this.userIndex = [];
                this.userValue = [];
              }
            }
          }
        },
      }).mount("#app");
    </script>
  </body>
</html>
