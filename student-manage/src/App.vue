<script setup>
import Lheader from './Lheader.vue';
import Laside from './Laside.vue';
import Lmain from './Lmain.vue';
import { getClass, openDatabase_class } from './class.js';
import { getStudent, openDatabase } from './indexedDB.js';
import { onMounted, provide, ref } from 'vue';

const LclassData = ref(null);

const studentData = ref(null);

const studentFlag = ref('');

const searchKey = ref('');

const fetchClassData = async () => {
  LclassData.value = await getClass();
}

const fetchStudentData = async () => {
  studentData.value = await getStudent();
}

const updateStudentFlag = (flag) => {
  studentFlag.value = flag;
}

const setSearchKey = (val) => {
  searchKey.value = val;
}

onMounted(() => {
  openDatabase();
  openDatabase_class();

  fetchClassData();
  fetchStudentData();
});

provide('LclassData', LclassData);
provide('setSearchKey', setSearchKey);
provide('fetchStudentData', fetchStudentData);
provide('fetchClassData', fetchClassData);


</script>
<template>
  <Lheader></Lheader>
  <Laside :student-data="studentData" @update-student-flag="updateStudentFlag"></Laside>
  <Lmain :student-data="studentData" :student-flag="studentFlag"></Lmain>
</template>