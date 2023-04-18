<template>
  <div>
    <ul>
      <li v-for="item in items" :key="item.id">
        {{ item.name }}
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { openDatabase, getData } from './indexedDB.js';

const items = ref([]);

onMounted(async () => {
  const db = await openDatabase('myDatabase', 1);
  const data = await getData(db, 'myData', 1);
  items.value = data;
});
</script>