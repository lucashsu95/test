<script setup>
import { ref } from 'vue';


const searchKey = ref('');

</script>

<template>
    <header id="header">
        <h1 id="logo">
            <span class="icon"><img src="./assets/images/menu.png" alt="123" /></span>
            學生資料
        </h1>
        <form id="searchForm" @submit.prevent="onSubmit">
            <span class="icon"><img src="./assets/images/search.png" alt="search" /></span>
            <input type="text" name="search" v-model="searchKey" placeholder="搜尋" />
        </form>
    </header>
</template>

<style scoped>
#header {
    grid-area: header;
    display: grid;
    grid-template-columns: 1.5fr 4fr;
}

#logo {
    display: flex;
    align-items: center;
    justify-content: center;
}

#logo .icon img {
    width: 35px;
}

.icon img {
    padding-right: 15px;
}

#searchForm {
    width: 95%;
    background-color: #eee;
    margin: 10px;
    border-radius: 10px;

    display: flex;
    align-items: center;
}

input[name="search"] {
    font-size: 16px;
    width: 100%;
    border: 0;
    outline: 0;
    background-color: #eee;
}
</style>