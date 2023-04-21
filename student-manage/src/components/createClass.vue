<script setup>
import { onMounted, ref } from 'vue';
import { openDatabase_class, addClass } from '../class.js';

defineProps({
    toggleDialogFlag: Boolean,
})

const className = ref('');

const emit = defineEmits(['close-dialog']);

const closeDialog = () => {
    emit('close-dialog');
}

const onSubmit = () => {
    addClass(JSON.stringify({
        id: new Date(),
        class_name: className.value,
    }))
    className.value = '';
    closeDialog();
    alert('儲存成功');
}

</script>

<template>
    <div id="dialog" :class="{ show: toggleDialogFlag }">
        <h2 class="title">建立班級</h2>
        <form class="newClass">
            <input type="text" name="name" v-model="className" placeholder="請輸入班級名稱">
            <div class="control-box">
                <button type='button' class="close" @click="closeDialog">取消</button>
                <button type='button' class="submit" @click="onSubmit">儲存</button>
            </div>
        </form>
    </div>
</template>

<style setup>
#dialog {
    padding: 25px;
    position: absolute;
    top: 50%;
    left: 50%;
    width: 400px;
    line-height: 60px;

    border: 1px solid #ccc;
    border-radius: 30px;
    background-color: #fff;
    box-shadow: 0 0 35px #ccc;

    transition: 300ms;
    transform: translate(-50%, -50%) scale(0);

    z-index: 3;
}

#dialog.show {
    transform: translate(-50%, -50%) scale(1);
}

input[name='name'] {
    width: 100%;
    padding: 5px;
    margin: 0;
    border: 0;
    border-bottom: 1px solid #ccc;
    outline: none;
}

input::placeholder {
    color: #bbb;
    font-size: 16px;
}

.control-box {
    width: auto;
    text-align: right;
}
</style>