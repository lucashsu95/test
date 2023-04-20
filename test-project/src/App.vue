<script setup>
import { ref } from 'vue';
import addItem from './components/addItem.vue';
const name = ref('hello,world!');
const postFontSize = ref(16);

const addFontSize = () => {
  postFontSize.value += 2;
}

</script>

<template>
  <h1>
    name:{{ name }}
  </h1>
  <div :style="{ fontSize: postFontSize + 'px' }">
    <addItem :title="name" @enlarge-text="addFontSize"></addItem>
  </div>
</template>