<script setup>
import { onMounted, provide, ref } from 'vue';
import { getClass } from './class.js';
import Lclass from './components/Lclass.vue';
import addStudent from './components/addStudent.vue';
import createClass from './components/createClass.vue';

const itemFlag = ref(-1);

const toggleDialogFlag = ref(false);

const toggleDialogClassFlag = ref(false);

const toggleDialog = () => {
    toggleDialogFlag.value = !toggleDialogFlag.value;
}

const toggleDialogClass = () => {
    itemFlag.value = -2;
    toggleDialogClassFlag.value = !toggleDialogClassFlag.value;
}

const LclassData = ref(null);

const renderView = () => {
    getClass().then((data) => {
        LclassData.value = data;
    })
}

onMounted(() => {
    renderView();
})

provide('LclassData',LclassData);

</script>

<template>
    <createClass :toggle-dialog-flag="toggleDialogClassFlag" @close-dialog="toggleDialogClass"></createClass>
    <addStudent :toggle-dialog-flag="toggleDialogFlag" @close-dialog="toggleDialog"></addStudent>
    <aside id="aside">
        <button id="addStudent" @click="toggleDialog">
            <span class="icon"><img src="./assets/images/add.png" alt="add.png" /></span>
            <h2>新增學生</h2>
        </button>

        <ul id="studentList" class="list">
            <li :class="{ current: itemFlag === -1 }" class="item" @click="itemFlag = -1">
                <span class="icon"><img src="./assets/images/person.png" alt="123" /></span>
                所有學生
                <div class="num">25</div>
            </li>
        </ul>

        <ul id="classList" class="list">
            <li v-for="classItem, i in LclassData" :key="classItem.id" class="item" :class="{ current: itemFlag === i }"
                @click="itemFlag = i">
                <Lclass>
                    {{ classItem.class_name }}
                </Lclass>
            </li>
            <li @click="toggleDialogClass" :class="{ current: itemFlag === -2 }" id="addClass" class="item">
                <span class="icon"><img src="./assets/images/add.png" alt="123" /></span>
                建立班級
            </li>
        </ul>

        <ul id="trash" class="list">
            <li :class="{ current: itemFlag === -3 }" class="item" @click="itemFlag = -3">
                <span class="icon"><img src="./assets/images/trash.png" alt="123" /></span>
                垃圾桶
            </li>
        </ul>
    </aside>
</template>


<style scoped>
#aside {
    grid-area: aside;
    display: flex;
    flex-direction: column;
}

#addStudent {
    width: 65%;
    display: flex;
    align-items: center;
    padding: 15px;
    margin: 10px;
    border-radius: 30px;
    background-color: #fff;
    box-shadow: 0 3px 5px #ccc;
}

#addStudent h2 {
    width: 100%;
    padding-left: 10px;
    display: flex;
    justify-content: center;
    font-size: 22px;
}

#studentList {
    border-bottom: 1px solid #ccc;
}

#classList {
    border-bottom: 1px solid #ccc;
}
</style>