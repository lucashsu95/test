<script setup>
import { ref } from 'vue';
import Lclass from './components/Lclass.vue';
import addStudent from './components/addStudent.vue';

const itemFlag = ref(-1);

const toggleDialogAdd = ref(false);

const close_dialog = (val) => {
    toggleDialogAdd.value = val
}

</script>

<template>
    <addStudent :toggle-dialog="toggleDialogAdd" @closeDialog="close_dialog"></addStudent>
    <aside id="aside">
        <button id="addStudent" @click="toggleDialogAdd = !toggleDialogAdd">
            <span class="icon"><img src="./assets/images/add.png" alt="123" /></span>
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
            <li :class="{ current: itemFlag === 0 }" class="item" @click="itemFlag = 0">
                <Lclass></Lclass>
            </li>
            <li :class="{ current: itemFlag === 1 }" class="item" @click="itemFlag = 1">
                <Lclass></Lclass>
            </li>
            <li :class="{ current: itemFlag === 2 }" class="item" @click="itemFlag = 2">
                <Lclass></Lclass>
            </li>
            <li :class="{ current: itemFlag === -2 }" id="addClass" class="item" @click="itemFlag = -2">
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