<script setup>
defineProps({
    url: String,
    num: [String, Number],
    flag: [String, Number]
})

</script>

<template>
    <li class="item">
        <img :src="url" alt="img" class="icon">
        <slot></slot>
        <div class="num">
            {{ num }}
        </div>
    </li>
</template>

<style scoped>
.item {
    display: flex;
    padding: 10px 15px;
    margin: 10px;
    align-items: center;
    border-radius: 30px;
    cursor: pointer;
}


.item:hover {
    background-color: #ddd;
}

.item.current {
    background-color: #c3e2ff;
    color: #39f;
}

.icon {
    width: 30px;
    margin-right: 10px;
}

.num {
    margin-left: auto;
    font-weight: bold;
}
</style>