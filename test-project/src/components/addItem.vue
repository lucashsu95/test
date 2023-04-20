<script setup>
import { defineProps,ref } from 'vue'

defineProps({
    myprop: {
        type: String,
        required: true
    }
})

const myproref = ref(myprop);

</script>

<template>
    <div>
        {{ myproref }}
    </div>
</template>
