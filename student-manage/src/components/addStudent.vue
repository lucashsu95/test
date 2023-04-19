<script setup>
import { onMounted, ref, defineEmits, defineProps } from 'vue';
import { addStudent } from '../indexedDB.js';

const props = defineProps({
    toggleDialog: {
        type: Boolean
    }
})

const hasImage = ref(true);
const emit = defineEmits(['closeDialog'])
const payload = ref({
    id: new Date(),
    avatar: '',
    last_name: '',
    first_name: '',
    student_id: getRandomNum(),
    email: '',
    phone: '',
    address: '',
    class: '資二智',
    note: '',
})


function getRandomNum() {
    const min = 100000;
    const max = 999999;
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

const onUpload = (e) => {
    const file = e.target.files[0];
    if (file) {
        const render = new FileReader();
        render.readAsDataURL(file);
        render.onload = () => {
            hasImage.value = false;
            payload.value.avatar = render.result;
        }
    }
}

const onSubmit = () => {
    if (confirm('確定送出嗎?')) {
        addStudent(JSON.stringify(payload.value));
        emit('closeDialog', false);
        alert('儲存成功');
    }
}
</script>

<template>
    <div id="dialog" :class="{ show: toggleDialog }">
        <h1>新增學生</h1>
        <hr>
        <form class="newStudent">
            <img src="../assets/images/人員000.png" class='avatar' v-show="hasImage" alt="">
            <img :src="payload.avatar" class='avatar' alt="" v-show="!hasImage">
            <input type="file" @change="onUpload" class='avatar_preview' placeholder="大頭貼">

            <input type="text" name="last_name" v-model="payload.last_name" placeholder="姓氏">
            <input type="text" name="first_name" v-model="payload.first_name" placeholder="名字">


            <img src="../assets/images/email.png" alt="email-icon">
            <input type="email" name="email" v-model="payload.email" placeholder="電子郵件">

            <input type="text" name="address" v-model="payload.address" placeholder="地址">

            <img src="../assets/images/phone.png" alt="phone-icon">
            <input type="tel" name="phone[]" v-model="payload.phone" placeholder="電話">


            <img src="../assets/images/tag.png" alt="tag-icon">
            <select name="class" v-model="payload.class">
                <option value="資二智" selected>資二智</option>
                <option value="資二仁">資二仁</option>
            </select>

            <img src="../assets/images/note.png" alt="note-icon">
            <input type="text" name="note" v-model="payload.note" placeholder="備註">

            <p class="control-box">
                <button type="button" class="close" @click="toggleDialog = false">取消</button>
                <button type="button" class="submit" @click="onSubmit">儲存</button>
            </p>

        </form>
    </div>
</template>

<style scoped>
img {
    width: 30px;
    height: 30px;
}

#dialog {
    padding: 25px;
    position: absolute;
    top: 50%;
    left: 50%;
    width: 700px;
    line-height: 50px;


    border: 1px solid #ccc;
    border-radius: 30px;
    background-color: #fff;
    box-shadow: 0 0 30px #ddd;

    transition: 300ms;
    transform: translate(-50%, -50%) scale(0);

    z-index: 3;
}

#dialog.show {
    transform: translate(-50%, -50%) scale(1);
}

.newStudent {
    display: grid;
    grid-auto-columns: 1fr;
    grid-gap: 20px;
    position: relative;
    justify-items: center;
    align-items: center;
}

hr {
    margin: 30px 0;
}

.control-box {
    grid-area: 7 / 7 / 8 / 11;
}

.control-box button {
    padding: 10px 25px;
    margin: 0 5px;
    border: none;
    outline: none;
    background: none;
    box-shadow: none;
    font-weight: bold;
    color: #39f;
    border-radius: 20px;
    transition: .3s;
}

.control-box button:hover {
    letter-spacing: 5px;
    color: #fff;
    background: #39f;
}

.newStudent input {
    width: 100%;
    padding: 5px;
    margin: 0;
    border: 0;
    border-bottom: 1px solid #ccc;
    outline: none;
}

.newStudent input::placeholder {
    color: #bbb;
    font-size: 16px;
}

.newStudent .avatar_preview {
    width: 50px;
    height: 50px;
    position: absolute;
    top: 0;
    left: 5px;
    opacity: 0;
}

.newStudent .avatar {
    border-radius: 50%;
    width: 60px;
    height: 60px;
    grid-area: 1 / 1 / 2 / 2;
    object-fit: cover;
}

.newStudent input[name='last_name'] {
    grid-area: 1 / 2 / 2 / 6;
}

.newStudent input[name='first_name'] {
    grid-area: 1 / 6 / 2 / 10;
}

.newStudent img[alt='email-icon'] {
    width: auto;
    zoom: 60%;
    grid-area: 2 / 1 / 3 / 2;
}

.newStudent input[name='email'] {
    grid-area: 2 / 2 / 3 / 10;
}

.newStudent input[name='address'] {
    grid-area: 3 / 2 / 4 / 10;
}

.newStudent input[name='phone[]'] {
    grid-area: 4 / 2 / 5 / 10;
}

.newStudent img[alt='phone-icon'] {
    grid-area: 4 / 1 / 5 / 2;
    width: auto;
    zoom: 80%;
}

.newStudent img[alt='tag-icon'] {
    width: auto;
    zoom: 60%;
    grid-area: 5 / 1 / 6 / 2;
}

.newStudent select[name='class'] {
    grid-area: 5 / 2 / 6 / 10;
    margin: 0;
}

.newStudent input[name='note'] {
    grid-area: 6 / 2 / 7 / 10;
}

.newStudent img[alt='note-icon'] {
    grid-area: 6 / 1 / 7 / 2;
    zoom: 70%;
    width: auto;
}
</style>