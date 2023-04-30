<script setup>
import TheMain from './components/TheMain.vue';
import TheHeader from './components/TheHeader.vue';
import TheAside from './components/TheAside.vue';
import { getStudent, getClass, openDatabase, openDatabaseClass } from './indexedDB';
import { onMounted, provide, ref } from 'vue';
const classData = ref();
const studentData = ref();
const filterFlag = ref(-1);
const search = ref();

const fetchStudentData = async () => {
  studentData.value = await getStudent();
}
const fetchClassData = async () => {
  classData.value = await getClass();
}

onMounted(() => {
  openDatabase();
  openDatabaseClass();

  fetchStudentData();
  fetchClassData();

})

provide('studentData', studentData);
provide('classData', classData);
provide('filterFlag', filterFlag);
provide('fetchStudentData', fetchStudentData);

</script>

<template>
  <TheHeader v-model:search="search"></TheHeader>
  <TheAside></TheAside>
  <TheMain :search="search"></TheMain>
</template>

<style scoped></style>