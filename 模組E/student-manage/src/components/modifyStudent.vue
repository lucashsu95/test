<script setup>
import TheDialog from './icons/TheDialog.vue';
import { inject, ref } from 'vue';
import { updateStudent } from '../indexedDB';

const props = defineProps({
    payload: Object,
})

const emailLength = ref(1);

const phoneLength = ref(1);

const onUpload = (e) => {
    const file = e.target.files[0];
    const render = new FileReader();
    render.readAsDataURL(file);
    render.onload = () => {
        payload.value.avatar = render.result;
    }
}

const toggleDialogStudent = inject('toggleDialogStudent');

const fetchStudentData = inject('fetchStudentData');

const onSubmit = () => {
    updateStudent(JSON.stringify(props.payload));
    fetchStudentData();
    toggleDialogStudent();
}

</script>

<template>
    <TheDialog flag="toggleDialogStudent" :payload="payload" :email-length="emailLength" :phone-length="phoneLength"
        :onUpload='onUpload' :onSubmit="onSubmit">
        <template #header>修改學生</template>
    </TheDialog>
</template>