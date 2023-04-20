<script setup>
defineProps({
    title: String,
})

const emit = defineEmits(['enlarge-text']);

const fs_test = () => {
    emit('enlarge-text')
}

</script>

<template>
    <div class="blog-post">
        <h4>title:{{ title }}</h4>
        <button @click="fs_test">Enlarge text</button>
    </div>
</template>