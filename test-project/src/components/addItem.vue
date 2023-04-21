<!-- c.vue -->
<script setup>
import { ref, inject } from 'vue';
import { addClass } from '../function';


const payload = ref({
    id: new Date(),
    class_name: 'test',
    keyword: '',
})

const liFlag = inject('liFlag');

const emit = defineEmits(['update-select']);

const updateFlag = (e) => {
    emit('update-select', e.target.dataset.key);
}

const onSubmit = () => {
    console.log(payload.value);
    addClass(JSON.stringify(payload.value));
    alert('儲存成功');
}

</script>
<template>
    <div id="addClass">
        <h1>selected</h1>
        <ul>
            {{ liFlag }}
            <li @click="updateFlag" data-key="" :class="{ show: liFlag == '' }">all</li>
            <li @click="updateFlag" data-key="test" :class="{ show: liFlag == 'test' }">test</li>
            <li @click="updateFlag" data-key="test2" :class="{ show: liFlag == 'test2' }">test2</li>
        </ul>
        <h1>新增</h1>
        <hr>
        <p>
            <select name="class" id="class" v-model="payload.class_name">
                <option value="test">test</option>
                <option value="test2">test2</option>
            </select>
        </p>
        <p>
            <input type="text" name="keyword" v-model="payload.keyword" placeholder="請輸入key">
        </p>
        <button @click="onSubmit">submit</button>
    </div>
</template>
  

<style scoped>
#addClass {
    padding: 25px;
}

div {
    background-color: #EDDE;
    color: #aad;
}

li {
    list-style: none;
    border: 1px solid #ccc;
    border-radius: 25px;
    background-color: #fff;
    padding: 15px;
    margin: 10px;
    color: #39f;
}

li.show {
    color: #fff;
    cursor: pointer;
    background-color: #39f;
}
</style>