<script setup>
import { onMounted, ref } from 'vue';


const items = ref([
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

const ul = ref();
const viewSize = 10;
const liHeight = 70;
const startIndex = ref(0);
const keepLi = ref();
const scrollTop = ref(0);

onMounted(() => {
  ul.value.style.height = `${viewSize * liHeight}px`;
  keepLi.value.style.height = `${(items.value.length - viewSize) * liHeight}px`;
})

const studentScroll = (e) => {
  scrollTop.value = e.target.scrollTop;
  startIndex.value = Math.floor(scrollTop.value / liHeight);
  // console.log(items.value);
}

</script>

<template>
  <section class="students" ref="ul" @scroll="studentScroll">
    <div v-for="item in items.slice(startIndex, startIndex + viewSize)"
      :style="{ transform: 'translateY(' + scrollTop + 'px)' }">
      {{ item.id }}
    </div>
    <div ref="keepLi"></div>

  </section>
</template>


<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.students {
  width: 500px;
  overflow-y: scroll;
  list-style-type: none;
}

.students div{
  padding: 23px 0;
}
</style>