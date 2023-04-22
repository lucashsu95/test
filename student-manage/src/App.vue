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

provide('studentData', studentData);
provide('LclassData', LclassData);
provide('studentFlag', studentFlag);
provide('searchKey', searchKey);
provide('setSearchKey', setSearchKey);
provide('fetchStudentData', fetchStudentData);
provide('fetchClassData', fetchClassData);


</script>
<template>
  <Lheader></Lheader>
  <Laside @update-student-flag="updateStudentFlag"></Laside>
  <Lmain></Lmain>
</template>