<script setup>
import TheDialog from './icons/TheDialog.vue';

</script>

<template>
    <TheDialog flag="toggleDialogClass">
        <template #header>新增班級</template>
        <template #body>
            <input type="text" name="class_name" id="">
            <button type="submit">儲存</button>
            <button type="reset">取消</button>
        </template>

    </TheDialog>
</template>