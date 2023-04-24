<script setup>
import { inject, ref } from 'vue';
import { deleteStudent } from '../indexedDB.js';
import modifyStudent from './modifyStudent.vue';


const props = defineProps({
    studentData: Object,
})

const toggleDialogFlag = ref(false);

const studentMouseIndex = ref(false);

const refreshStudentData = inject('fetchStudentData');

const toggleDialog = () => {
    toggleDialogFlag.value = !toggleDialogFlag.value
}

const destroyStudent = (data) => {
    deleteStudent(data);
    refreshStudentData();
}

</script>

<template>
    <modifyStudent :payload="studentData" :toggle-flag="toggleDialogFlag"
        @close-dialog="toggleDialog">
    </modifyStudent>
    <div class="student" @mouseover="studentMouseIndex = true" @mouseleave="studentMouseIndex = false">
        <img :src="studentData.avatar" alt="avatar" class="avatar" />
        <div class="fullname">{{ studentData.last_name + studentData.first_name }}</div>
        <div class="student_id">{{ studentData.student_id }}</div>
        <div class="email">{{ studentData.email[0] }}<template v-if="studentData.email.length > 1">...</template></div>
        <div class="phone">{{ studentData.phone[0] }}<template v-if="studentData.phone.length > 1">...</template></div>
        <div class="class">{{ studentData.class }}</div>
        <div class="address">{{ studentData.address }}</div>
        <div class="actions" v-show="studentMouseIndex && studentData.class !== 'trash'">
            <div class="edit" @click="toggleDialog" :data-id="studentData.id">編輯</div>
            <div class="delete" @click="destroyStudent(JSON.stringify(studentData))">刪除</div>
        </div>
    </div>
</template>

<style scoped>
.student:hover {
    background-color: #ddd;
}

.actions {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0.9;
    display: flex;
}

.actions div {
    cursor: pointer;
    padding: 10px 15px;
    border: 1.2px solid #39f;
    color: #39f;
    margin: 5px;
    background-color: #fff;
    border-radius: 4px;
}

.class {
    display: flex;
    flex-direction: column;
}

.class div {
    background-color: #bbb;
    border-radius: 5px;
    padding: 2px;
    margin: 1px;
}

.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}
</style>