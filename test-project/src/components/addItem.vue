<!-- c.vue -->
<template>
    <div>
        <h2>我是子组件C</h2>
    </div>
</template>
  
<script setup>
const emits = defineEmits(['childMethod'])

const childMethod = () => {
    emits('childMethod')
}
</script>