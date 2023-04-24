<script setup>
import { ref } from 'vue';

const props = defineProps({
    toggleDialogFlag: Boolean
})

const emit = defineEmits(['update-dialog-flag', 'update-order-sort'])

const orderItemFlag = ref('');

const sortItemFlag = ref(0);

const Lorder = ref('');

const Lsort = ref('asc');

const closeDialog = () => {
    emit('update-dialog-flag');
}

const toggleSort = () => {
    emit('update-order-sort', Lorder.value, Lsort.value);
    closeDialog();
}

</script>

<template>
    <div id="sort" v-show="toggleDialogFlag">
        <h2>Sort排序</h2>
        <ul @change="toggleSort">
            <label for="name" @click="orderItemFlag = 0" :class="{ show: orderItemFlag === 0 }">姓名</label>
            <li><input type="radio" name="order" id="name" v-model="Lorder" value="last_name"></li>
            <label for="student_id" @click="orderItemFlag = 1" :class="{ show: orderItemFlag === 1 }">學號</label>
            <li><input type="radio" name="order" id="student_id" v-model="Lorder" value="student_id"></li>
            <label for="email" @click="orderItemFlag = 2" :class="{ show: orderItemFlag === 2 }">電子郵件</label>
            <li><input type="radio" name="order" id="email" v-model="Lorder" value="email[0]"></li>
        </ul>

        <ul @change="toggleSort">
            <label for="asc" @click="sortItemFlag = 0" :class="{ show: sortItemFlag === 0 }">升冪</label>
            <li><input type="radio" name="sort" id="asc" v-model="Lsort" value="asc"></li>
            <label for="desc" @click="sortItemFlag = 1" :class="{ show: sortItemFlag === 1 }">降冪</label>
            <li><input type="radio" name="sort" id="desc" v-model="Lsort" value="desc"></li>
        </ul>
    </div>
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
    padding: 15px;
    line-height: 35px;

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
    background: #bbf;
    color: #fff;
}

.show {
    background: #39f;
    color: #fff;
}

input[type='radio'] {
    display: none;
}
</style>