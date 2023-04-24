<script setup>
import { computed, inject, ref } from "vue";
import Lclass from "./components/Lclass.vue";
import addStudent from "./components/addStudent.vue";
import createClass from "./components/createClass.vue";

const students = inject("studentData");

const LclassData = inject("LclassData");

const itemFlag = ref(-1);

const toggleDialogFlag = ref(false);

const toggleDialogClassFlag = ref(false);

const emit = defineEmits(["update-student-flag"]);

const studentNumber = computed(() => {
  if (students.value) {
    const data = students.value.filter((x) => x.class !== "trash");
    return data.length;
  }
});

const toggleDialogClass = () => {
  itemFlag.value = -2;
  toggleDialogClassFlag.value = !toggleDialogClassFlag.value;
};

const updateFlag = (item, index) => {
  itemFlag.value = index;
  emit("update-student-flag", item);
};

const classLength = (Lclass) => {
  if (students.value) {
    const data = students.value.filter((x) => x.class === Lclass);
    return data.length;
  }
};
</script>

<template>
  <addStudent :toggle-dialog-flag="toggleDialogFlag" @close-dialog="toggleDialogFlag = !toggleDialogFlag"></addStudent>
  <createClass :toggle-dialog-flag="toggleDialogClassFlag" @close-dialog="toggleDialogClass">
  </createClass>
  <aside id="aside">
    <button id="addStudent" @click="toggleDialogFlag = !toggleDialogFlag">
      <span class="icon"><img src="./assets/images/add.png" alt="add.png" /></span>
      <h2>新增學生</h2>
    </button>

    <ul id="studentList" class="list">
      <li :class="{ current: itemFlag === -1 }" class="item" @click="updateFlag('', -1)">
        <span class="icon"><img src="./assets/images/person.png" alt="123" /></span>
        所有學生
        <div class="num">{{ studentNumber }}</div>
      </li>
    </ul>

    <ul id="classList" class="list">
      <li v-for="(classItem, i) in LclassData" :key="classItem.id" class="item" :class="{ current: itemFlag === i }"
        @click="updateFlag(classItem.class_name, i)">
        <Lclass :class_name="classItem.class_name" :num="classLength(classItem.class_name)"></Lclass>
      </li>
      <li @click="toggleDialogClass" :class="{ current: itemFlag === -2 }" id="addClass" class="item">
        <span class="icon"><img src="./assets/images/add.png" alt="123" /></span>
        建立班級
      </li>
    </ul>

    <ul id="trash" class="list">
      <li :class="{ current: itemFlag === -3 }" class="item" @click="updateFlag('trash', -3)">
        <span class="icon"><img src="./assets/images/trash.png" alt="123" /></span>
        垃圾桶
      </li>
    </ul>
  </aside>
</template>

<style scoped>
#aside {
  grid-area: aside;
  display: grid;
  grid-template-rows: 1fr 1fr 5fr 1fr;
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
  overflow-y: hidden;
}

#classList:hover {
  padding-right: 0;
  overflow-y: auto;
}

#classList::-webkit-scrollbar {
  width: 10px;
}

#classList::-webkit-scrollbar-track {
  background-color: #f1f1f1;
}

#classList::-webkit-scrollbar-thumb {
  background-color: #888;
  border-radius: 5px;
}

</style>
