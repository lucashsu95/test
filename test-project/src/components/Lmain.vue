<script setup>
import item from './item.vue';
import { ref } from 'vue';
const items = ref([
    {
        name: 'cow',
        kg: '65'
        ,
    },
    {
        name: 'pig',
        kg: '80'
        ,
    },
    {
        name: 'dog',
        kg: '11'
        ,
    },
    {
        name: 'cat',
        kg: '5'
        ,
    },
    {
        name: 'fish',
        kg: '3'
        ,
    },
    {
        name: 'chicken',
        kg: '7'
        ,
    },
    {
        name: 'cow',
        kg: '65'
        ,
    },
    {
        name: 'pig',
        kg: '80'
        ,
    },
    {
        name: 'dog',
        kg: '11'
        ,
    },
    {
        name: 'cat',
        kg: '5'
        ,
    },
    {
        name: 'fish',
        kg: '3'
        ,
    },
    {
        name: 'chicken',
        kg: '7'
        ,
    },
]);
</script>

<template>
    <div id="main">
        <item v-for="item in items" :item-name="item.name" :item-kg="item.kg"></item>
    </div>
</template>

<style>
#main{
    overflow-y: auto;
    grid-area: main;
}
</style>