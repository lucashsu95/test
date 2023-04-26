<script setup>
import { provide, ref } from 'vue';
import TheItem from './icons/TheItem.vue';
import addStudent from './addStudent.vue'
import addClass from './addClass.vue';

const itemFlag = ref(-1);

const showAddStudent = ref(false);

const showAddClass = ref(false);

const toggleItemFlag = (flag) => {
    itemFlag.value = flag;
}

const toggleDialogStudent = () => { showAddStudent.value = !showAddStudent.value }

const toggleDialogClass = () => showAddClass.value = !showAddClass.value;

provide('toggleDialogStudent', toggleDialogStudent);
provide('toggleDialogClass', toggleDialogClass);

</script>

<template>
    <aside id="aside">
        <button id="addStudent" @click="toggleDialogStudent"><img src="../assets/images/add.png" alt="add"
                class="icon">新增學生</button>
        <addStudent v-if="showAddStudent"></addStudent>


        <ul id="studentList" class="list">
            <TheItem :class="{ current: itemFlag === -1 }" @click="toggleItemFlag(-1)" url="/src/assets/images/person.png"
                text="所有學生" num="16">
                所有學生
            </TheItem>
        </ul>
        <ul id="classList" class="list">
            <TheItem :class="{ current: itemFlag === 0 }" @click="toggleItemFlag(0)" url="/src/assets/images/tag.png"
                num="12">test1</TheItem>
            <TheItem :class="{ current: itemFlag === 1 }" @click="toggleItemFlag(1)" url="/src/assets/images/tag.png"
                num="4">test2</TheItem>
            <TheItem @click="toggleDialogClass" url="/src/assets/images/add.png">創建班級
            </TheItem>
            <addClass v-if="showAddClass"></addClass>
        </ul>
        <ul id="trash" class="list">
            <TheItem :class="{ current: itemFlag === -3 }" @click="toggleItemFlag(-3)" url="/src/assets/images/trash.png">
                垃圾桶
            </TheItem>
        </ul>
        <ul class="list">
            <TheItem url="/src/assets/images/export.png">
                下載資料</TheItem>
            <TheItem url="/src/assets/images/import.png">
                載入資料</TheItem>
        </ul>
    </aside>
</template>

<style scoped>
#aside {
    grid-area: aside;
    display: grid;
    grid-template-rows: 1fr 1fr 5fr 1fr;
}

.list {
    border-bottom: 1px solid #ccc;
}

#addStudent {
    max-width: 175px;
    font-size: 20px;

    display: flex;
    align-items: center;
    justify-content: center;

    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 25px;
    margin: 10px;
    padding: 10px;
    cursor: pointer;
    box-shadow: 0 2px 5px #ddd;
}

.icon {
    width: 45px;
    padding-right: 15px;
}
</style>