<script setup>
import addItem from "./components/addItem.vue";
import { ref } from "vue";

const page = ref(1)
const butFn = (val) => {
  page.value = val
}

</script>
<template>
  <addItem :page="page" @toggleDialog="butFn"></addItem>
</template >