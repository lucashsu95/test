<script setup>
import { inject } from 'vue';
import TheDialog from './icons/TheDialog.vue';


const studentData = inject('studentData');

const classData = inject('classData');

const onSubmit = () => {
    const data = JSON.stringify({ "student": studentData.value, "class": classData.value });
    console.log(data);
    const blob = new Blob([data], { type: 'text/csv;charset=utf-8' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.setAttribute('href', url);
    link.setAttribute('download', 'data.csv');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
}

</script>

<template>
    <TheDialog flag="toggleDialogExport">
        <template #header>
            匯出資料
        </template>
        <template #other-btn>
            <button type="button" id="export_data" @click="onSubmit">滙出</button>
        </template>
    </TheDialog>
</template>