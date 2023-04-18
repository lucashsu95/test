<template>
    <div>
        <button
            @click="addData({ id: new Date, Lclass: Math.round(Math.random()) ? '資二仁' : '資二智', title: Math.round(Math.random()) ? '維生素C' : '會開心', content: Math.round(Math.random()) ? '蘋果' : '香蕉' })">+</button>
    </div>
</template>

<script setup>
import { addData } from '../indexedDB.js';
</script>