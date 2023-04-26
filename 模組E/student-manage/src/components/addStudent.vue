<script setup>
import { ref } from 'vue';
import TheDialog from './icons/TheDialog.vue';


const payload = ref({
    id: new Date(),
    avatar: '',
    last_name: '',
    first_name: '',
    student_id: '',
    address: '',
    email: [],
    phone: [],
    note: '',
    note2: '',
})

const onUpload = (e) => {
    const file = e.target.files[0];
    const render = new FileReader();
    render.readAsDataURL(file);
    render.onload = () => {
        payload.value = render.result;
    }
}

</script>

<template>
    <TheDialog flag="toggleDialogStudent">
        <template #header>新增學生</template>
        <template #body>
            <input type="file" class="avatar">
            <img src="" alt="" class="avatar_preview" @change="onUpload">
            <input type="text" name="last_name" v-model="payload.last_name">
            <input type="text" name="first_name" v-model="payload.first_name">
        </template>

    </TheDialog>
</template>