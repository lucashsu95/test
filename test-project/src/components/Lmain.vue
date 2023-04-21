<!-- c.vue -->
<script setup>
import { inject } from 'vue';

const datas = inject('datas');

const keyword = inject('keyword', '');

const liFlag = inject('liFlag');


</script>
<template>
    <div id="list">
        <h1>LIST</h1>
        <hr>
        <div v-for="data in datas">
            {{ data.class_name }}
            <template v-if="data.class_name == liFlag || liFlag === ''">
                <p v-for="item in data">
                    {{ item }}
                </p>
            </template>
        </div>
    </div>
</template>
  

<style scoped>
#list {
    background-color: #dea;
    color: #faa;
    padding: 25px;
}

#list div {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    width: 80%;
    border: 2px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    justify-items: center;
    margin: 5px auto;
    color: #39f;
}
</style>