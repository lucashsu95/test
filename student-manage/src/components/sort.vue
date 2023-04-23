<script setup>
import { provide, ref } from 'vue';

defineProps({
    toggleDialogFlag: Boolean,
})

const emit = defineEmits(['update-dialog-flag'])

const order = ref('');

const sort = ref('asc');

const itemFlag = ref(0);

provide('order', order);

provide('sort', sort);

const closeDialog = () => {
    emit('update-dialog-flag');
}

const toggleSort = () =>{

}
</script>

<template>
    <div id="sort" v-show="toggleDialogFlag">
        <ul @change="toggleSort">
            <label for="name">姓名</label>
            <li><input type="radio" name="order" id="name" v-model="order"></li>
            <label for="student_id">學號</label>
            <li><input type="radio" name="order" id="student_id" v-model="order"></li>
            <label for="email">電子郵件</label>
            <li><input type="radio" name="order" id="email" v-model="order"></li>
        </ul>

        <ul>
            <label for="asc">升冪</label>
            <li><input type="radio" name="sort" id="asc" v-model="sort"></li>
            <label for="desc">降冪</label>
            <li><input type="radio" name="sort" id="desc" v-model="sort"></li>
        </ul>
    </div>
    <div id="sortBg" v-show="toggleDialogFlag" @click="closeDialog"></div>
</template>


<style scoped>
#sort {
    position: absolute;
    top: 10px;
    right: 30px;

    width: 250px;
    height: 125px;

    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0 35px #ddd;

    z-index: 3;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

ul {
    display: flex;
}

label {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
    margin: 5px;
    cursor: pointer;
}

label:hover {
    background: #39f;
    color: #fff;
}

input[type='radio'] {
    display: none;
}

#sortBg{
    position: absolute;
    top: 30px;
    width: 200vh;
    height: 100vh;
    background-color: #fff;
    z-index: 2;
}
</style>