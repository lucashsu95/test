<script setup>
import { computed } from "@vue/reactivity";
import { ref } from "vue";

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
    <h1>台幣、日幣、美幣換算</h1>
    <hr>
        <p>1 日幣 = 0.278 台幣</p>
        <p>1 美幣 = 28.540 台幣</p>
    <hr>
    <section>
      <p>
        <label for="twd"><h3>台幣：</h3><input type="text" name="twd" id="twd" v-model="twd" /></label>元
      </p>
      <p>
        <label for="jpy"><h3>日幣：</h3><input type="text" name="jpy" id="jpy" v-model="jpy" /></label>元
      </p>
      <p>
        <label for="usd"><h3>美幣：</h3><input type="text" name="usd" id="usd" v-model="usd" /></label>元
      </p>
    </section>
</template>

<style scoped>
</style>
