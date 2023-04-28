<script setup>
import { computed, ref } from 'vue';


const studentData = ref([
  {
    id: 1,
    name: 'John',
  },
  {
    id: 2,
    name: 'Lucas',
  },
  {
    id: 3,
    name: 'tea',
  },
  {
    id: 4,
    name: 'cook',
  },
  {
    id: 5,
    name: 'teach',
  },
  {
    id: 6,
    name: 'print',
  },
  {
    id: 7,
    name: 'nine',
  },
  {
    id: 8,
    name: 'jack',
  },
  {
    id: 9,
    name: 'dick',
  },
  {
    id: 10,
    name: 'abc',
  },
  {
    id: 11,
    name: 'input',
  },
  {
    id: 12,
    name: 'sort',
  },
  {
    id: 13,
    name: 'delete',
  },
  {
    id: 14,
    name: 'update',
  },
  {
    id: 15,
    name: 'sorted',
  },
  {
    id: 16,
    name: 'filter',
  },
  {
    id: 17,
    name: 'other',
  },
  {
    id: 18,
    name: 'array',
  },
  {
    id: 19,
    name: 'list',
  },
  {
    id: 20,
    name: 'set',
  },
  {
    id: 21,
    name: 'tuple',
  },
]);

const itemStart = ref(0);

const itemLength = 10;

const itemCount = 3;

const items = computed(() => { return studentData.value.splice(itemStart.value, itemLength) });

const ul = ref();

const studentScroll = (e) => {
  const scrollTop = e.target.scrollTop;
  console.log(`scrollTop:${scrollTop}`);
}

</script>

<template>
  <div>
    <section class="students" ref="ul" @scroll="studentScroll">
      <div v-for="i in 10" class="student">
        {{ items[itemStart + i - 1].id }}
        {{ items[itemStart + i - 1].name }}
      </div>
    </section>
    <hr>
    <section>
      <button @click="ul.scrollTop = 0">重製高度</button>
    </section>


  </div>
</template>


<style scoped>
* {
  box-sizing: border-box;
}

.students {
  width: 700px;
  height: 500px;
  overflow: auto;
  background-color: #ddd;
  border: 2px solid #f60;
  list-style-type: none;
}

.student {
  display: flex;
  justify-content: center;
  padding: 23px;
  outline: 1px solid #f90
}
</style>