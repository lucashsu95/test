<template>
    <div>
        <button @click="handleClick">Click me</button>
        <p>{{ message }}</p>
    </div>
</template>
  
<script setup>
import { openDatabase } from '/src/indexedDB.js'

let message = ''

function handleClick() {
    openDatabase('myDatabase', 1)
        .then(db => {
            const store = db.transaction('myData').objectStore('myData')
            return store.get(1)
        })
        .then(data => {
            message = data.name
        })
        .catch(error => {
            console.error(error)
        })
}
</script>
  