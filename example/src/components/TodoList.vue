<script setup>
import { ref } from "vue";

const countList = ref([
  {
    id: 1,
    value: "this is a apple",
    check: false,
  },
  {
    id: 2,
    value: "i am John",
    check: false,
  },
]);

const count = ref(3);

const text = ref("");

const addCount = () => {
  count.value++;

  const id = count.value;
  const value = text.value;

  const item = {
    id: id,
    value: value,
  };
  countList.value.push(item);
  text.value = "";
};

const closeItem = (e) => {
  const id = e.target.dataset.id;
  countList.value = countList.value.filter((e) => e.id != id);
};
</script>

<template>

    <h1>TodoList</h1>
    <hr />
    <div>
      <input type="text" name="add" v-model="text" placeholder="請輸入待辦事項" />
      <button @click="addCount">Add</button>
    </div>
    <div class="container">
      <div v-for="key in countList" :key="key" class="item">

        <input type="checkbox" name="checkbox" v-model="key.check" />
        <h2 class="content" :class="{ active: key.check }" v-text="key.value"></h2>
        <button :data-id="key.id" @click="closeItem">x</button>
        
      </div>
    </div>
</template>

<style scoped>

.item {
  padding: 10px;
  margin: 10px;
  border-radius: 10px;
  border: 2px solid #fda;
  display: grid;
  grid-template-columns: 15% 70% 15%;
  align-items: center;
}
.content.active {
  text-decoration: line-through;
}

input[type='checkbox']{
  zoom: 150%;
}
</style>
