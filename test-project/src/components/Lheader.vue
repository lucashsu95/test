<!-- c.vue -->
<script setup>
import { ref, inject } from 'vue';

const key = ref('');


</script>
<template>
    <div id="header">
        <input type="text" name="key" v-model="key" @keydown.enter="searchkey" placeholder="搜尋">
    </div>
</template>
  

<style scoped>
#header{
    font-size: 20px;
    line-height: 40px;
}

input{
    padding: 10px 20px;
    margin: 10px;
    border:0;
    border-radius: 6px;
    box-shadow: 0 0 5px #eee;
    outline: none;
}
</style>