<script setup>
import TheDialog from './icons/TheDialog.vue';
import { addClass, addStudent,createStudentId } from '../indexedDB';
import { inject, ref } from 'vue';

const fileData = ref();

const studentData = inject('studentData');

const classData = inject('classData');

const onUpload = (e) => {
    const file = e.target.files[0];
    const render = new FileReader();
    render.readAsText(file);
    render.onload = () => {
        const data = JSON.parse(render.result);
        fileData.value = data;
        console.log(fileData.value['class']);
    }
}

const onSubmit = () => {
    console.log(fileData.value);
    fileData.value['class'].forEach(TheClass => {
        const data = {
            id: new Date(),
            class_name: TheClass.class_name,
        }
        addClass(JSON.stringify(data));
        classData.value.push(data);
    });

    fileData.value['student'].forEach(TheStudent => {
        let data2 = TheStudent;
        data2.avatar = data2.avatar ? data2.avatar : '/src/assets/images/人員000.png';
        data2.student_id = createStudentId();
        data2.id = new Date();
        addStudent(JSON.stringify(TheStudent));
        studentData.value.push(TheStudent);
    })
}

</script>

<template>
    <TheDialog flag="toggleDialogImport">
        <template #header>
            匯入資料
        </template>
        <template #other>
            <input type="file" name="file" @change="onUpload">
        </template>
        <template #other-btn>
            <button type="button" @click="onSubmit" id="import_data">滙入</button>
        </template>
    </TheDialog>
</template>

