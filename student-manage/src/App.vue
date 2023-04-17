<script setup>
import student from './components/student.vue';
import { ref } from 'vue';


const itemFlag = ref(-1);




</script>

<template>
  <header id="header">
    <h1 id="logo">
      <span class="icon"><img src="./assets/images/menu.png" alt="123" /></span>
      學生資料
    </h1>
    <form id="searchForm">
      <span class="icon"><img src="./assets/images/search.png" alt="" /></span>
      <input type="text" name="search" placeholder="搜尋" />
    </form>
  </header>
  <aside id="aside">
    <button id="addStudent">
      <span class="icon"><img src="./assets/images/add.png" alt="123" /></span>
      <h2>新增學生</h2>
    </button>

    <ul id="studentList" class="list">
      <li :class="{current:itemFlag === -1}" class="item" @click="itemFlag = -1">
        <span class="icon"><img src="./assets/images/person.png" alt="123" /></span>
        所有學生
        <div class="num">25</div>
      </li>
    </ul>

    <ul id="classList" class="list">
      <li :class="{current:itemFlag === 0}" class="item" @click="itemFlag = 0">
        <span class="icon"><img src="./assets/images/tag.png" alt="123" /></span>
        班級301{{ asideItems }}
        <div class="num">13</div>
      </li>
      <li :class="{current:itemFlag === 1}" class="item" @click="itemFlag = 1">
        <span class="icon"><img src="./assets/images/tag.png" alt="123" /></span>
        班級302
        <div class="num">3</div>
      </li>
      <li :class="{current:itemFlag === 2}" class="item" @click="itemFlag = 2">
        <span class="icon"><img src="./assets/images/tag.png" alt="123" /></span>
        班級303
        <div class="num">9</div>
      </li>
      <li :class="{current:itemFlag === -2}" id="addClass" class="item" @click="itemFlag = -2">
        <span class="icon"><img src="./assets/images/add.png" alt="123" /></span>
        建立班級
      </li>
    </ul>

    <ul id="trash" class="list">
      <li :class="{current:itemFlag === -3}" class="item" @click="itemFlag = -3">
        <span class="icon"><img src="./assets/images/trash.png" alt="123" /></span>
        垃圾桶
      </li>
    </ul>
  </aside>
  <div id="main">
    <div class="students">
      <div class="student">
        <div class="fullname">名稱</div>
        <div></div>
        <div class="student_id">學號</div>
        <div class="email">電子郵件</div>
        <div class="phone">電話號碼</div>
        <div class="class">標號</div>
        <div class="address">地址</div>
        <div class="actions">
          <div class="edit">編輯</div>
          <div class="delete">刪除</div>
        </div>
        <article class="student_tool">
          <div class="due"></div>
          <div class="due"></div>
          <div class="due"></div>
        </article>
      </div>
      <student>
      </student>


    </div>
  </div>
</template>

<style scoped></style>
