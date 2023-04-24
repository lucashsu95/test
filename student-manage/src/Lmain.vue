<script setup>
import student from "./components/student.vue";
import sort from "./components/sort.vue";
import { computed, inject, ref } from "vue";

const students = inject("studentData");

const studentFlag = inject("studentFlag");

const searchKey = inject('searchKey');

const toggleDialogFlag = ref(false);

const filterStudents = computed(() => {
    if (students.value) {
        const data = students.value.filter(x => x.class === studentFlag.value || (studentFlag.value === '' && x.class !== 'trash'))
        return data;
    }
});

const toggleDialog = () => {
    toggleDialogFlag.value = !toggleDialogFlag.value;
}

const orderBy = (order, direction) => {
    const compareFunc = (x, y) => {
        if (direction === 'asc') {
            return x[order] - y[order];
        } else {
            return y[order] - x[order];
        }
    };
    console.log(filterStudents.value);
    filterStudents.value = filterStudents.value.sort(compareFunc);
    // console.log(filterStudents.value, direction);
}
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

                <sort :toggle-dialog-flag="toggleDialogFlag" @update-order-sort="orderBy"
                    @update-dialog-flag="toggleDialog">
                </sort>

                <article class="student_tool" @click="toggleDialog">
                    <div class="due"></div>
                    <div class="due"></div>
                    <div class="due"></div>
                </article>
            </div>
            <template v-for="(student) in filterStudents">
                <student :studentData="student"></student>
            </template>
            <div class="message" v-if="filterStudents == ''">目前沒有學生</div>
        </div>
    </div>
</template>

<style>
#main {
    grid-area: main;
    overflow-x: hidden;
    overflow-y: auto;
}

#main::-webkit-scrollbar {
    width: 10px;
}

#main::-webkit-scrollbar-track {
    background-color: #f1f1f1;
}

#main::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 5px;
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

.message {
    font-size: 20px;
    text-align: center;
    margin: 10px;
}
</style>
