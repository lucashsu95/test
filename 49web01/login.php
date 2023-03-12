<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.47/vue.global.js' integrity='sha512-2zwx0mkoR2cxZY0humPK79YhJYgoX5lT+WNqkgTcV7qhVm3+msjlmOgoXnN1cW2r9qqbZez3XhnLZsyW3k8Wtg==' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div id="app">

    <form action="loginprocess.php" method="post">
        <h1>電子競技網站管理登入</h1>
        <p>account:<input type="text" name="account"></p>
        <p>password:<input type="password" name="password"></p>
        <p>圖片驗證碼:
            <div class='userInput' @dragover.prevent="" @drop="hello"></div>
        </p>
        <div class="user-select">
            <img v-for="num in nums" @dragstart="dragStart" :data-value="num" :src="'captcha.php?num='+num" draggable="true" />
        </div>
        <div class="images">
            <img  v-for="num in captcha1" :src="'captcha.php?num='+num" draggable="true" />
            <img :src="'captcha.php?num=' + (symbol ? 'x' : '-')" />
            <img  v-for="num in captcha2" :src="'captcha.php?num='+num" draggable="true" />
        </div>
        從大到小排列:
        <button @click.prevent="renderCaptcha">重新產生驗證碼</button>
        <button type="submit" class='btn'>送出</button>
        <button type="reset" class='btn'>重設</button>
        <input type="hidden" name="ans" :value="calcuateAnswer">
        <input type="hidden" name="user_answer" :value="userAns.join('')">
    </form>
</div>
    <script>
        const app = Vue.createApp({
            data() {
                return {
                    captcha1: [],
                    captcha2: [],
                    ans: [],
                    userAns: [],
                    nums: new Array(10).fill(0).map((_,i) => i),
                    dragingDom: null,
                    symbol: false,
                }
            },
            computed:{
                calcuateAnswer() {
                    const c1 = parseInt(this.captcha1.join(''));
                    const c2 = parseInt(this.captcha2.join(''));

                    return this.symbol ? c1 + c2 : c1 - c2;
                }
            },
            methods: {
                renderCaptcha() {
                    let captcha = [];
                    this.symbol = Math.round(Math.random() * 1);

                    for (let i=0;i<2;i++) {
                        const random = Math.floor(Math.random() * this.nums.length);
                        this.captcha1.push(this.nums[random]);
                        
                    }
                    for (let i=0;i<2;i++) {
                        const random = Math.floor(Math.random() * this.nums.length);
                        this.captcha2.push(this.nums[random]);
                    }
                },
                dragStart(event) {
                    const ele = event.target.cloneNode(true);
                    this.dragingDom = ele;
                },
                hello(event) {
                    event.target.appendChild(this.dragingDom);
                    this.userAns.push(this.dragingDom.dataset.value);
                },
            },
            mounted() {
                this.renderCaptcha();
            }
        }).mount('#app');
    </script>
</body>
</html>