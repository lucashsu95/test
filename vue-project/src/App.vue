<script setup>
import { RouterLink, RouterView } from "vue-router";
import { ref } from "vue";
import { computed } from "@vue/reactivity";

const countList = ref([
  {
    id: 1,
    value: "this is a apple",
    check: false,
  },
  {
    id: 2,
    value: "i am John",
    check: false,
  },
]);

const page = ref(0);

const pages = ref({
  TodoList: 0,
  "台幣、日幣、美幣換算": 1,
});

// ----------TodoList----------
const count = ref(3);

const text = ref("");

const addCount = () => {
  count.value++;

  const id = count.value;
  const value = text.value;

  const item = {
    id: id,
    value: value,
  };
  countList.value.push(item);
  text.value = "";
};

const closeItem = (e) => {
  const id = e.target.dataset.id;
  countList.value = countList.value.filter((e) => e.id != id);
};

// ----------台幣、日幣、美幣換算----------

const twd = ref(0);
const jpy = ref(0);
const usd = ref(0);

//https://book.vue.tw/CH1/1-3-computed-and-methods.html#computed-methods-%E7%9A%84%E4%BD%BF%E7%94%A8%E6%99%82%E6%A9%9F%E6%AF%94%E8%BC%83
</script>

<template>
  <button v-for="(key, value) in pages" :class="{ active: page === key }" @click="page = key">
    {{ value }}
  </button>

  <section v-show="page === 0">
    <h1>TodoList</h1>
    <hr />
    <div>
      <input type="text" name="add" v-model="text" placeholder="請輸入待辦事項" />
      <button @click="addCount">Add</button>
    </div>
    <div class="container">
      <div v-for="key in countList" :key="key">
        <input type="checkbox" name="checkbox" v-model="key.check" />
        <h2 class="content" :class="{ active: key.check }" v-text="key.value"></h2>
        <button :data-id="key.id" @click="closeItem">x</button>
      </div>
    </div>
  </section>

  <section v-show="page === 1">
    <h1>台幣、日幣、美幣換算</h1>

    <hr />

    <div>
      <p>
        <label for="twd">台幣：<input type="text" name="twd" id="twd" v-model="twd" /></label>元
      </p>
      <p>
        <label for="jpy">日幣：<input type="text" name="jpy" id="jpy" v-model="jpy" /></label>元
      </p>
      <p>
        <label for="usd">美幣：<input type="text" name="usd" id="usd" v-model="usd" /></label>元
      </p>
    </div>

    <hr />

    <p>1 日幣 = 0.278 台幣</p>
  </section>
</template>

<style scoped>
.container>div {
  padding: 10px;
  margin: 10px;
  border-radius: 10px;
  border: 2px solid #fda;
  display: flex;
  align-items: center;
}

.content.active {
  text-decoration: line-through;
}
</style>
