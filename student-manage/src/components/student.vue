<script setup>
import { ref, onMounted } from 'vue';

const studentMouseIndex = ref(null);
const props = defineProps({
    n: {
        type: Object,
        required: true,
    }
})
const showButtons = (index) => {
    studentMouseIndex.value = index;
}

</script>


<template>
    <div class="student" data-id="1" @mouseover="showButtons(0)" @mouseleave="studentMouseIndex = null">
        <img :src="n.avatar" alt="avatar" class="avatar" />
        <div class="fullname">{{ n.last_name + n.first_name }}</div>
        <div class="student_id">{{ n.id }}</div>
        <div class="email">{{ n.email }}</div>
        <div class="phone">{{ n.phone }}</div>
        <div class="tag">
            <div>測試1</div>
            <div>測試2</div>
        </div>
        <div class="address">{{ n.address }}</div>
        <div class="actions" v-show="studentMouseIndex === 0">
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
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}
</style>