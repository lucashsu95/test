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

const fetchClassData = async () => {
  LclassData.value = await getClass();
}

const fetchStudentData = async () => {
  studentData.value = await getStudent();
}

const updateStudentFlag = (flag) => {
  studentFlag.value = flag;
}

provide('studentData', studentData);
provide('LclassData', LclassData);
provide('studentFlag', studentFlag);

onMounted(() => {
  openDatabase();
  openDatabase_class();

  fetchClassData();
  fetchStudentData();
});
</script>

<template>
  <Lheader></Lheader>
  <Laside @update-student-flag="updateStudentFlag"></Laside>
  <Lmain></Lmain>
</template>