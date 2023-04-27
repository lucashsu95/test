<script setup>
import { provide, ref, inject } from 'vue';
import modifyStudent from '../modifyStudent.vue';
import { deleteStudent } from '../../indexedDB';

const props = defineProps({
    titleData: Boolean,
    studentData: Object,
})

const studentMouseIndex = ref(false);

const toggleDialogFlag = ref(false);

const fetchStudentData = inject('fetchStudentData');

const toggleDialogStudent = () => {
    toggleDialogFlag.value = !toggleDialogFlag.value
}

const destroyStudent = (data) => {
    deleteStudent(JSON.stringify(data));
    fetchStudentData();
}

provide('toggleDialogStudent', toggleDialogStudent);

</script>

<template>
    <modifyStudent :payload="studentData" v-if="toggleDialogFlag"></modifyStudent>
    <div class="student" @mouseover="studentMouseIndex = true" @mouseleave="studentMouseIndex = false">
        <img :src="studentData.avatar" alt="" class="avatar" :class="{ noShow: titleData }">
        <span v-if='titleData'></span>
        <div class="fullname">{{ studentData.last_name + studentData.first_name }}</div>
        <div class="studnet_id">{{ studentData.student_id }}</div>
        <div class="email">{{ studentData.email[0] }}</div>
        <div class="phone">{{ studentData.phone[0] }}</div>
        <div class="class">{{ studentData.class }}</div>
        <div class="address">{{ studentData.address }}</div>
        <div class="actions" v-show="studentMouseIndex">
            <button class="edit" @click='toggleDialogStudent'>編輯</button>
            <button class="delete" @click="destroyStudent(studentData)">刪除</button>
        </div>
    </div>
</template>

<style scoped>
.student {
    width: 100%;
    display: grid;
    justify-items: center;
    align-items: center;
    grid-template-columns: 0.6fr repeat(2, 1fr) repeat(2, 2fr) repeat(2, 1fr);
    padding: 10px 5px;
    transition: .5s all;
    border-radius: 10px;
    position: relative;
}

.student:hover {
    background-color: #ccc;
}

.avatar {
    width: 50px;
    height: 50px;
    object-fit: cover;
    display: block;
    border-radius: 50%;
}

.actions {
    position: absolute;
    zoom: 85%;
}

.noShow {
    display: none;
}

.edit,
.delete {
    border: 1px solid #39f;
    border-radius: 30px;
}
</style>