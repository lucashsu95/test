<script setup>
import TheDialog from './icons/TheDialog.vue';
import { inject, ref } from 'vue';
import { addStudent, createStudentId } from '../indexedDB';

const emailLength = ref(1);

const phoneLength = ref(1);

const payload = ref({
    id: new Date(),
    avatar: '/src/assets/images/人員000.png',
    last_name: '',
    first_name: '',
    student_id: createStudentId(),
    address: '',
    class: '請選擇班級',
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
        payload.value.avatar = render.result;
    }
}

const studentData = inject('studentData');

const toggleDialog = inject('toggleDialogStudent');

const onSubmit = () => {
    addStudent(JSON.stringify(payload.value));
    studentData.value.push(payload.value);
    toggleDialog();
}

</script>

<template>
    <TheDialog flag="toggleDialogStudent" :payload="payload" :email-length="emailLength" :phone-length="phoneLength"
        :onUpload='onUpload' :onSubmit="onSubmit">
        <template #header>新增學生</template>
    </TheDialog>
</template>

<style>
.avatar {
    display: none;
}

.icon {
    width: 35px;
}

img[alt='phone'] {
    zoom: 60%;
}

.avatar_preview {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 50%;
}

.add {
    zoom: 65%;
}
</style>