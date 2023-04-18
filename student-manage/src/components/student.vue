<script setup>
import { ref } from 'vue';


const studentMouseIndex = ref(null);

const showButtons = (index) => {
    studentMouseIndex.value = index;
}

</script>


<template>
    <div class="student" data-id="1" @mouseover="showButtons(0)" @mouseleave="studentMouseIndex = null">
        <img src="../assets/images/人員009.png" alt="avatar" class="avatar" />
        <div class="fullname">測試009</div>
        <div class="student_id">016006</div>
        <div class="email">test006@abc.com</div>
        <div class="phone">0900 000 006</div>
        <div class="tag">
            <div>測試1</div>
            <div>測試2</div>
        </div>
        <div class="address">新北市三重區</div>
        <div class="actions" v-show="studentMouseIndex === 0">
            <div class="edit">編輯</div>
            <div class="delete">刪除</div>
        </div>
    </div>
    <div class="student" data-id="2" @mouseover="showButtons(1)" @mouseleave="studentMouseIndex = null">
        <img src="../assets/images/人員006.png" alt="avatar" class="avatar" />
        <div class="fullname">測試006</div>
        <div class="student_id">016021</div>
        <div class="email">lucashsu95@gmail.com</div>
        <div class="phone">0984 307 998</div>
        <div class="tag">
            <div>測試2</div>
        </div>
        <div class="address">新北市三重區自強路</div>
        <div class="actions" v-show="studentMouseIndex === 1">
            <div class="edit">編輯</div>
            <div class="delete">刪除</div>
        </div>
    </div>
</template>

<style scoped>
.student:hover {
    background-color: #bbb;
}

.actions {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0.9;
    display: flex;
}

.actions div {
    cursor: pointer;
    padding: 10px 15px;
    border: 1.2px solid #39f;
    color: #39f;
    margin: 5px;
    background-color: #fff;
    border-radius: 4px;
}

.class {
    display: flex;
    flex-direction: column;
}

.class div {
    background-color: #bbb;
    border-radius: 5px;
    padding: 2px;
    margin: 1px;
}

.avatar {
    width: 50px;
    padding: 5px;
}
</style>