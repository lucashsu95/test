<script setup>
defineProps({
    itemName: String,
    itemKg: Number,
})
</script>

<template>
    <div id="item">
        <h3>
            {{ itemName }}
        </h3>
         ：
        <h4>
            {{ itemKg }}
        </h4>
    </div>
</template>

<style>
#item {
    border: 3px solid #bbb;
    margin: 10px;
    padding: 10px;

    display: flex;
    justify-content: center;
    align-items: center;

}
</style>