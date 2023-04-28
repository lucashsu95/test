<script setup>
import { computed, inject, ref } from 'vue';
import TheStudent from './icons/TheStudent.vue';

const props = defineProps({
    search: String,
});

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

</script>

<template>
    <main id="main">
        <div class="students">
            <TheStudent :student-data="title" :title-data="true"></TheStudent>
            <hr>
            <TheStudent v-for="student in filterStudent" :student-data="student"></TheStudent>
        </div>
    </main>
</template>

<style scoped>
#main {
    grid-area: main;
    overflow-y: auto;
}

#main::-webkit-scrollbar {
    width: 10px;
}

#main::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 10px;

}
</style>