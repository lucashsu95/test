<script setup>
import { inject, ref } from 'vue';
import { deleteStudent,backDeleteStudent } from '../indexedDB.js';
import modifyStudent from './modifyStudent.vue';

const studentMouseIndex = ref(null);

const props = defineProps({
    studentData: Object,
    studentIndex: Number,
})

const showButtons = (index) => {
    studentMouseIndex.value = index;
}

const toggleDialogFlag = ref(false);

const toggleDialog = () => {
    toggleDialogFlag.value = !toggleDialogFlag.value
}

</script>

<template>
    <modifyStudent :student_index="studentIndex" :payload="studentData" :toggle-flag="toggleDialogFlag"
        @close-dialog="toggleDialog">
    </modifyStudent>
    <div class="student" @mouseover="showButtons(0)" @mouseleave="studentMouseIndex = null">
        <img :src="studentData.avatar" alt="avatar" class="avatar" />
        <div class="fullname">{{ studentData.last_name + studentData.first_name }}</div>
        <div class="student_id">{{ studentData.student_id }}</div>
        <div class="email">{{ studentData.email }}</div>
        <div class="phone">{{ studentData.phone }}</div>
        <div class="class">{{ studentData.class }}</div>
        <div class="address">{{ studentData.address }}</div>
        <div class="actions" v-show="studentMouseIndex === 0">
            <div class="edit" @click="toggleDialog" :data-id="studentData.id">編輯</div>
            <template v-if="studentData.class !== 'trash'">
                <div class="delete" @click="deleteStudent(JSON.stringify(studentData))" :data-id="studentData.id">刪除</div>
            </template>
            <template v-else>
                <div class="delete" @click="backDeleteStudent(JSON.stringify(studentData))" :data-id="studentData.id">復原</div>
            </template>
        </div>
    </div>
</template>

<style scoped>
.student:hover {
    background-color: #bbb;
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