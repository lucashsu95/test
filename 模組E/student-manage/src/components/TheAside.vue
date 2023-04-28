<script setup>
import { computed, inject, provide, ref } from 'vue';
import TheItem from './icons/TheItem.vue';
import addStudent from './addStudent.vue';
import addClass from './addClass.vue';
import TheExport from './TheExport.vue';
import TheImport from './TheImport.vue';

const itemFlag = inject('filterFlag');

const showAddStudent = ref(false);

const showAddClass = ref(false);

const showExport = ref(false);

const showImport = ref(false);

const studentData = inject('studentData');

const classData = inject('classData');

const AllstudentLength = computed(() => {
    if (studentData.value) {
        const data = studentData.value.filter((x) => x.note2 !== 'trash');
        return data.length;
    }
})

const studentLength = (flag) => {
    if (studentData.value) {
        return studentData.value.filter((x) => x.class == flag && x.note2 !== 'trash').length;
    }
};

const toggleItemFlag = (flag) => itemFlag.value = flag;

const toggleDialogStudent = () => showAddStudent.value = !showAddStudent.value;

const toggleDialogClass = () => showAddClass.value = !showAddClass.value;

const toggleDialogImport = () => showImport.value = !showImport.value

const toggleDialogExport = () => showExport.value = !showExport.value;;

provide('toggleDialogStudent', toggleDialogStudent);
provide('toggleDialogClass', toggleDialogClass);
provide('toggleDialogExport', toggleDialogExport)
provide('toggleDialogImport', toggleDialogImport)

</script>

<template>
    <aside id="aside">
        <button id="addStudent" @click="toggleDialogStudent"><img src="../assets/images/add.png" alt="add"
                class="icon">新增學生</button>
        <addStudent v-if="showAddStudent"></addStudent>


        <ul id="studentList" class="list">
            <TheItem :class="{ current: itemFlag === -1 }" @click="toggleItemFlag(-1)" url="/src/assets/images/person.png"
                text="所有學生" :num="AllstudentLength">
                所有學生
            </TheItem>
        </ul>
        <ul id="classList" class="list">
            <TheItem v-for="i in classData" :class="{ current: itemFlag === i.class_name }"
                @click="toggleItemFlag(i.class_name)" url="/src/assets/images/tag.png" :num="studentLength(i.class_name)">
                {{ i.class_name }}
            </TheItem>
            <TheItem @click="toggleDialogClass" url="/src/assets/images/add.png">創建班級
            </TheItem>
            <addClass v-if="showAddClass"></addClass>
        </ul>
        <ul id="trash" class="list">
            <TheItem :class="{ current: itemFlag === -2 }" @click="toggleItemFlag(-2)" url="/src/assets/images/trash.png">
                垃圾桶
            </TheItem>
        </ul>
        <ul class="list">
            <TheExport v-if="showExport"></TheExport>
            <TheImport v-if="showImport"></TheImport>
            <TheItem url="/src/assets/images/export.png" @click="toggleDialogExport">
                滙出資料</TheItem>
            <TheItem url="/src/assets/images/import.png" @click="toggleDialogImport">
                滙入資料</TheItem>
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

    color: #333;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 25px;
    margin: 10px;
    padding: 10px;
    cursor: pointer;
    box-shadow: 0 2px 5px #ddd;
}

#studentList {
    padding-right: 10px;
}

#classList {
    overflow-y: auto;
}

#classList::-webkit-scrollbar {
    width: 10px;
}

#classList::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 10px;
}

.icon {
    width: 45px;
    padding-right: 15px;
}
</style>