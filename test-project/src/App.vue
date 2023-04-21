<!-- a.vue -->
<script setup>
import Lheader from './components/Lheader.vue';
import Lmain from './components/Lmain.vue';
import addItem from './components/addItem.vue';
import { openDatabase_class, getClass } from './function';
import { ref, onMounted, provide } from 'vue'

const classData = ref(null);

const fetchData = async () => {
  classData.value = await getClass();
}

const searchkey = () => {
  console.log(key.value);
}

const liFlag = ref('');

const updateSelect = (val) => {
  liFlag.value = val;
  console.log(liFlag.value);
  provide('liFlag', liFlag)
}

provide('datas', classData);
provide('liFlag', liFlag)

onMounted(() => {
  openDatabase_class();
  fetchData();
})

</script>

<template>
  <div id="main">
    <Lheader></Lheader>
    <Lmain></Lmain>
    <addItem @update-select="updateSelect"></addItem>
  </div>
</template>

<style scoped>
#main {
  width: 100%;
  height: 60vh;
  padding: 25px 0;
  background-color: #39f;
}
</style>
