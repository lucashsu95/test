<script setup>
import TheNumber from "./components/TheNumber.vue";
import { computed, ref } from "vue";

const interval = ref(null);
const ms = ref(0);

const start = () => {
  interval.value = setInterval(() => {
    ms.value += 10;
    if (ms.value == 9990) {
      clearInterval(interval.value);
    }
  }, 10);
};

const stop = () => {
  clearInterval(interval.value);
};

const clear = () => {
  ms.value = 0;
};

const a = computed(() => {
  return Math.floor(ms.value / 1000);
});

const b = computed(() => {
  return Math.floor(ms.value / 100) % 10;
});

const c = computed(() => {
  return Math.floor(ms.value / 10) % 10;
});
</script>

<template>
  <div class="container" id="app">
    <TheNumber :n="a" />
    <div class="due">
      <div class="circle"></div>
      <div class="circle"></div>
    </div>
    <TheNumber :n="b" />
    <TheNumber :n="c" />
  </div>
  <button class="start" @click="start">start</button>
  <button class="stop" @click="stop">stop</button>
  <button class="clear" @click="clear">clear</button>
</template>

<style scoped>
.container {
  /* width: 500px;
            height: 500px; */
  font-size: 55px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 100px 0;
}

.due {
  display: flex;
  flex-direction: column;
  justify-content: space-evenly;
  align-items: center;
  width: 40px;
  height: 380px;
}

.circle {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background-color: #db4c4c;
}
</style>
