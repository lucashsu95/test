<script setup>
import { ref, onMounted } from 'vue';
import { openDatabase, getData } from './indexedDB.js';
import addItem from './components/addItem.vue';

const items = ref([]);

onMounted(async () => {
  const db = await openDatabase('myDatabase', 1);
  const data = await getData(db, 'myData', 1);
  items.value = data;
});

</script>
<template>
  <div>
    <addItem></addItem>
    <ul>
      <li v-for="item in items" :key="item.id">
        {{ item.title }}
        {{ item.Lclass }}
        {{ item.content }}
      </li>
    </ul>
  </div>
</template>

