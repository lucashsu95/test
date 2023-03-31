<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { ref } from "vue";

const countList = ref([
  {
     id:1,
     value:"this is a apple",
  }
  ,{
     id:2,
     value:"i am John",
    }
  ,{
     id:3,
     value:"i am lucas",
    }
  ]);

const count = ref(3);

const text = ref("");

const addCount = () => {

  count.value++;

  const id = count.value;
  const value = text.value;

  const item = {
     id: id,
     value: value
  }
  countList.value.push(item);
  text.value = "";

};


const closeItem = (e) => {
  const id = e.target.dataset.id;
  countList.value = countList.value.filter(e => e.id != id);
};


</script>

<template>
  <h1>TodoList</h1>
  <div>
    <input type="text" name="add" v-model="text" placeholder="請輸入待辦事項"/>
    <button @click="addCount">Add</button>
  </div>
  <div class="container">
    <div v-for="key in countList" :key="key">
      <input type="checkbox" name="checkbox">
      <h1 v-text="key.id"></h1>
      <h2 v-text="key.value"></h2>
      <button :data-id="key.id" @click="closeItem">x</button>
    </div>
  </div>
</template>

<style scoped>
button,
input {
  margin: 10px;
  padding: 10px 15px;
  font-size: 20px;
  font-weight: bold;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button{
  cursor: pointer;
}

.container>div {
  padding: 10px;
  margin: 10px;
  border-radius: 10px;
  border: 2px solid #faa;
  display: flex;
  align-items: center;
}
</style>
