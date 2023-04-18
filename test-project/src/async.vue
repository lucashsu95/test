<template>
    <div>
        <button @click="handleClick">Click me</button>
        <p>{{ message }}</p>
    </div>
</template>
  
<script setup>
import { openDatabase } from '/src/indexedDB.js';

let message = ''

async function handleClick() {
    try {
        const db = await openDatabase('myDatabase', 1)
        const store = db.transaction('myData').objectStore('myData')
        const data = await store.get(1)
        message = data.name
    } catch (error) {
        console.error(error)
    }
}
</script>
  