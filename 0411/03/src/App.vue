<script setup>
  import { ref } from 'vue';

  const prevNum = ref(0);
  const currNum = ref('');
  const oper = ref(['+','-','*','/']);
  const onSubmit = ref(()=>{
    currNum.value = (Math.round(eval(currNum.value) * 100) / 100 ).toString();
  })

</script>

<template>
  <div class="container">

  <button @click="currNum = ''">C</button>
  <div class="show">
    {{ currNum }}
  </div>
    <button @click="currNum += '0'">0</button>
    <button v-for="i in 9" @click="currNum += i">{{ i }}</button>
    <button v-for="i in oper" @click="currNum += i">{{ i }}</button>
    <button @click="currNum+='.'">.</button>
    <button @click="onSubmit">=</button>

  </div>
</template>

<style scoped>
  *{
    font-family: Arial, Helvetica, sans-serif;
  }

  body{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100vh;
  }

  .container{
    display: grid;
    grid-auto-columns: 1fr;
    width: 300px;
    border:1px solid #ddd;
    border-radius: 5px;
  }
  
  button{
    padding: 10px;
    margin: 5px;
    border:0;
    border-radius: 5px;
    background-color: #bbf;
  }

  button:nth-of-type(1){
    grid-area: 1 / 1 / 2 / 2;
  }
  .show{
    grid-area: 1 / 2 / 2 / 5;
    display: flex;
    justify-content: end;
    align-items: center;
    padding-right:20px;
    border:1px solid #bbb;
    border-radius: 5px;
  }


</style>