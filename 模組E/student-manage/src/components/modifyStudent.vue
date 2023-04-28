<script setup>
import TheDialog from './icons/TheDialog.vue';
import { inject, ref } from 'vue';
import { updateStudent } from '../indexedDB';

const props = defineProps({
    payload: Object,
})

const student = ref({ ...props.payload });

const emailLength = ref(student.value.email.length);

const phoneLength = ref(student.value.phone.length);

const onUpload = (e) => {
    const file = e.target.files[0];
    const render = new FileReader();
    render.readAsDataURL(file);
    render.onload = () => {
        student.value.avatar = render.result;
    }
}

const toggleDialogStudent = inject('toggleDialogStudent');

const fetchStudentData = inject('fetchStudentData');

const onSubmit = () => {
    updateStudent(JSON.stringify(student.value));
    fetchStudentData();
    toggleDialogStudent();
}

</script>

<template>
    <TheDialog flag="toggleDialogStudent" :payload="student" :email-length="emailLength" :phone-length="phoneLength"
        :onUpload='onUpload' :onSubmit="onSubmit">
        <template #header>修改學生</template>
    </TheDialog>
</template>