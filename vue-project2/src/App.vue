<script setup>
import { computed } from "@vue/reactivity";
import { ref } from "vue";

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

const page = ref(2);

const pages = ref({
  'TodoList': 0,
  "台幣、日幣、美幣換算": 1,
  "Test": 2,
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

const twd = ref(1);
const jpy = computed({
  get() {
    return Number.parseFloat(Number(twd.value) / 0.28).toFixed(2);
  },
  set(val) {
    twd.value = Number.parseFloat(Number(val) * 0.28).toFixed(2);
  }
});

const usd = computed({
  get() {
    return Number.parseFloat(Number(twd.value) / 28.54).toFixed(2);
  },
  set(val) {
    twd.value = Number.parseFloat(Number(val) * 28.54).toFixed(2);
  }
});

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
    <hr>
    <p>1 日幣 = 0.278 台幣</p>
    <p>1 美幣 = 28.540 台幣</p>
    <hr>
    <div>
      <p>
        <label for="twd"><h3>台幣：</h3><input type="text" name="twd" id="twd" v-model="twd" /></label>元
      </p>
      <p>
        <label for="jpy"><h3>日幣：</h3><input type="text" name="jpy" id="jpy" v-model="jpy" /></label>元
      </p>
      <p>
        <label for="usd"><h3>美幣：</h3><input type="text" name="usd" id="usd" v-model="usd" /></label>元
      </p>
    </div>

    <hr>

  </section>
  <section v-show="page === 2">
    <h1>Test</h1>
    
    
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
