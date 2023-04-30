<script setup>
import { computed, inject, onMounted, provide, ref } from 'vue';
import TheStudent from './icons/TheStudent.vue';
import TheSort from './TheSort.vue';

const props = defineProps({
    search: String,
});

const ul = ref();
const keepLi = ref();
const viewSize = 9;
const liHeight = 70;
const startIndex = ref(0);
const scrollTop = ref(0);

const studentData = inject('studentData');

const filterFlag = inject('filterFlag');

const filterStudent = computed(() => {
    if (studentData.value) {
        let data = studentData.value.filter((x) => x.note2 !== 'trash');

        if (filterFlag.value != -1) {
            data = data.filter((x) => x.class === filterFlag.value);
        }

        if (filterFlag.value === -2) data = studentData.value.filter(x => x.note2 === 'trash');

        if (props.search) {
            data = data.filter(x => x.last_name.includes(props.search) || x.first_name.includes(props.search)
                || x.student_id.includes(props.search) || x.email.includes(props.search)
                || x.phone.includes(props.search) || x.address.includes(props.search));
        }

        return data;
    }
})

const filterStudentLength = computed(() => {
    if (filterStudent.value) {
        return filterStudent.value.length;
    }
})

const studentCanView = computed(() => {
    if (filterStudent.value) {
        return filterStudent.value.slice(startIndex.value, startIndex.value + viewSize)
    }
})

const title = ref({
    avatar: '',
    last_name: '',
    first_name: '名稱',
    student_id: '學號',
    address: '地址',
    class: '班級',
    email: ['電子郵件'],
    phone: ['電話號碼']
})

const showTheSort = ref(false);

const toggleDialogSort = () => showTheSort.value = !showTheSort.value;

const studentScroll = (e) => {
    scrollTop.value = e.target.scrollTop;
    startIndex.value = Math.floor(scrollTop.value / liHeight);
}

onMounted(() => {
    ul.value.style.height = `${viewSize * liHeight}px`;
})

provide('toggleDialogSort', toggleDialogSort)

</script>

<template>
    <main id="main">
        <TheStudent :student-data="title" :title-data="true"></TheStudent>
        <div class="sort-box" @click="toggleDialogSort">
            <div class="due"></div>
            <div class="due"></div>
            <div class="due"></div>
        </div>
        <TheSort v-if="showTheSort"></TheSort>
        <hr>
        <div class="students" ref="ul" @scroll="studentScroll">
            <TheStudent v-for="student in studentCanView" :student-data="student"
                :student-style="{ transform: 'translateY(' + scrollTop + 'px)' }"></TheStudent>
            <div ref="keepLi" :style="{ 'height': (filterStudentLength - viewSize) * liHeight + 'px' }"></div>
        </div>
    </main>
</template>

<style scoped>
#main {
    grid-area: main;
}

.students {
    height: 100%;
    overflow-y: scroll;
}

.students::-webkit-scrollbar {
    width: 10px;
}

.students::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 10px;
}

.sort-box {
    position: absolute;
    width: 30px;
    height: 30px;
    top: calc(10vh + 5px);
    right: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
}

.sort-box:hover {
    background-color: #aaa;
}

.due {
    width: 2px;
    height: 2px;
    background-color: #333;
    border-radius: 50%;
    padding: 2px;
    margin: 1.5px;
}
</style>