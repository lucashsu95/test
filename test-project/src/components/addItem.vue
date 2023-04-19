<template>
    <button @click="butFn">改变page值:{{ page }}</button>
</template>
  
<script setup>
const props = defineProps({
    page: {
        type: String,
    }
});

const emit = defineEmits(["toggleDialog"]);   //定义一个变量来接收父组件传来的方法

const butFn = () => {
    emit("toggleDialog", 5)
}
</script>