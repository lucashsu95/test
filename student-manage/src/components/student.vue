<script setup>



</script>


<template>
    <div class="student" data-id="1" @mouseenter="e => e.target.classList.add('control')"
        @mouseout="e => e.target.classList.remove('control')">
        <img src="../assets/images/人員009.png" alt="avatar" class="avatar" />
        <div class="fullname">測試009</div>
        <div class="student_id">016006</div>
        <div class="email">test006@abc.com</div>
        <div class="phone">0900 000 006</div>
        <div class="class">
            <div>測試1</div>
            <div>測試2</div>
        </div>
        <div class="address">新北市三重區</div>
        <div class="actions">
            <div class="edit">編輯</div>
            <div class="delete">刪除</div>
        </div>
    </div>
    <div class="student" data-id="2">
        <img src="../assets/images/人員006.png" alt="avatar" class="avatar" />
        <div class="fullname">測試006</div>
        <div class="student_id">016021</div>
        <div class="email">lucashsu95@gmail.com</div>
        <div class="phone">0984 307 998</div>
        <div class="class">
            <div>測試2</div>
        </div>
        <div class="address">新北市三重區自強路</div>
        <div class="actions">
            <div class="edit">編輯</div>
            <div class="delete">刪除</div>
        </div>
        <div class="controlStudent">
            <button>編輯</button>
            <button>刪除</button>
        </div>
    </div>
</template>

<style scoped>
.control {
    background-color: #aaa;
}
</style>