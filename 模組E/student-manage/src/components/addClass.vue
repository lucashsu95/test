<script setup>
import { inject, ref } from 'vue';
import TheDialog from './icons/TheDialog.vue';
import { addClass } from '../indexedDB';

const emit = defineEmits(['close-dialog'])

const classData = inject('classData');

const onSubmit = () => {
    addClass(JSON.stringify(payload.value));
    classData.value.push(payload.value);
    toggleDialogClass();
}
const toggleDialogClass = inject('toggleDialogClass');



const payload = ref({
    id: new Date,
    class_name: '',
})

</script>

<template>
    <TheDialog flag="toggleDialogClass" :payload="payload" :on-submit="onSubmit">
        <template #header>新增班級</template>
        <template #body>
            <input type="text" name="class_name" placeholder="請輸入班級">
        </template>
    </TheDialog>
</template>

<style scoped>
input {
    height: 50px;
}
</style>