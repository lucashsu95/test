<script setup>
defineProps({
    search: String,
})

defineEmits(['update:search'])

</script>
<template>
    <header id="header">
        <h1 id="logo"><img src="../assets/images/menu.png" alt="menu" class="icon">學生資料</h1>
        <form id="searchForm">
            <img src="../assets/images/search.png" alt="search" class="icon">
            <input type="text" name="search" placeholder="搜尋" :value="search" @input="$emit('update:search',$event.target.value)">
        </form>
    </header>
</template>
<style scoped>
#header {
    grid-area: header;
    display: grid;
    grid-template-columns: 1fr 4fr;
    align-items: center;
}

#logo {
    display: flex;
    justify-content: center;
    align-items: center;
}

.icon {
    width: 25px;
    margin: 0 10px;
}

#searchForm {
    width: 95%;
    height: 80%;
    display: flex;
    align-items: center;
    background-color: #ddd;
    border-radius: 10px;
    margin: 10px;
    padding: 10px 15px;
}

input[name='search'] {
    width: 100%;
    height: 100%;
    border-radius: 10px;
    outline: none;
    border: none;
    background-color: #dddddd00;
    margin: auto;
    font-size: 16px;
}
</style>