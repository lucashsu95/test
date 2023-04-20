<script setup>
import student from './components/student.vue';
import { openDatabase, getStudent } from './indexedDB.js';
import { onMounted, provide, ref } from 'vue';

const students = ref(null);

const renderView = () => {
    openDatabase();
    getStudent().then((data) => {
        students.value = data;
    })
}

onMounted(() => {
    renderView();
})

provide('payload', students)

</script>

<template>
    <div id="main">
        <div class="students">
            <div class="student">
                <div class="fullname">名稱</div>
                <div></div>
                <div class="student_id">學號</div>
                <div class="email">電子郵件</div>
                <div class="phone">電話號碼</div>
                <div class="class">班級</div>
                <div class="address">地址</div>

                <article class="student_tool">
                    <div class="due"></div>
                    <div class="due"></div>
                    <div class="due"></div>
                </article>

            </div>
            <student v-for="student, i in students" :studentIndex="i" :studentData="student"></student>
        </div>
    </div>
</template>

<style>
#main {
    grid-area: main;
}

.student {
    display: grid;
    grid-template-columns: 0.6fr repeat(2, 1fr) 2fr 2fr 1fr 1fr;
    align-items: center;
    padding: 10px;
    position: relative;
    transition: 200ms;
    border-radius: 4px;
}

.student_tool:hover {
    background-color: #ddd;
}

.student:first-child {
    border-bottom: 1px solid #ccc;
}

.student_tool {
    position: absolute;
    top: 50%;
    right: 0;
    transform: translateY(-50%);

    width: 20px;
    height: 20px;

    display: grid;
    grid-template-rows: repeat(3, 1fr);
    justify-content: center;
    align-items: center;

    border-radius: 50%;
    padding: 5px;
    transition: 300ms all;
}
</style>