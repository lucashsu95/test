<script setup>
import { inject, ref } from 'vue';
import { addStudent } from '../indexedDB.js';

const props = defineProps({
    toggleDialogFlag: Boolean,
})

const LclassData = inject('LclassData');

const refreshStudentData = inject('fetchStudentData');

const getRandomNum = () => {
    const min = 100000;
    const max = 999999;
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

const emailLength = ref(1);

const phoneLength = ref(1);

const emit = defineEmits(['close-dialog']);

const closeDialog = () => {
    emit('close-dialog');
}


const payload = ref({
    id: new Date(),
    avatar: '/src/assets/images/人員000.png',
    last_name: '',
    first_name: '',
    student_id: getRandomNum(),
    email: Array(emailLength.value).fill(''),
    phone: Array(phoneLength.value).fill(''),
    address: '',
    class: '請選擇班級',
    note: '',
})

const onUpload = (e) => {
    const file = e.target.files[0];
    console.log(file);
    const render = new FileReader();
    render.readAsDataURL(file);
    render.onload = () => {
        payload.value.avatar = render.result;
    }
}


const onSubmit = () => {
    if (payload.value.class == '請選擇班級') {
        alert('請選擇班級');
        return;
    } else if (payload.value.phone == '' || payload.value.email == '') {
        alert('請填寫完正確資訊');
    }

    if (confirm('確定送出嗎?')) {
        addStudent(JSON.stringify(payload.value));

        refreshStudentData();

        emailLength.value = 1;
        phoneLength.value = 1;

        closeDialog();
        payload.value = {
            id: new Date(),
            avatar: '/src/assets/images/人員000.png',
            last_name: '',
            first_name: '',
            student_id: getRandomNum(),
            email: Array(emailLength.value).fill(''),
            phone: Array(phoneLength.value).fill(''),
            address: '',
            class: '請選擇班級',
            note: '',
        }
        alert('儲存成功');
    }
}

</script>

<template>
    <div id="dialog" :class="{ show: toggleDialogFlag }">
        <h1>新增學生</h1>
        <hr>
        <form class="newStudent" @submit.prevent="onSubmit">
            <img :src="payload.avatar" class='avatar'>
            <input type="file" accept="image/*" @change="onUpload" class='avatar_preview' placeholder="大頭貼">

            <section class="name">
                <input type="text" name="last_name" v-model="payload.last_name" placeholder="姓氏" required>
                <input type="text" name="first_name" v-model="payload.first_name" placeholder="名字" required>
            </section>


            <img src="../assets/images/email.png" alt="email-icon">
            <section class="length">
                <input v-for='i in emailLength' type="email" name="email[]" v-model="payload.email[i - 1]"
                    :placeholder="'電子郵件' + i" required>
                <article>
                    <button type="button" @click="emailLength++">+</button>
                    <button type="button" @click="emailLength--">-</button>
                </article>
            </section>


            <img src="../assets/images/home.png" alt="address-icon">
            <input type="text" name="address" v-model="payload.address" placeholder="地址" required>


            <img src="../assets/images/phone.png" alt="phone-icon">
            <section class="length">
                <input v-for='i in phoneLength' type="tel" name="phone[]" v-model="payload.phone[i - 1]"
                    :placeholder="'電話' + i" required>
                <article>
                    <button type="button" @click="phoneLength++">+</button>
                    <button type="button" @click="phoneLength--">-</button>
                </article>
            </section>

            <img src="../assets/images/tag.png" alt="tag-icon">
            <select name="class" v-model="payload.class" required>
                <option value='請選擇班級' disabled selected>請選擇班級</option>
                <option v-for='Lclass in LclassData' :value="Lclass.class_name">{{ Lclass.class_name }}</option>
            </select>

            <img src="../assets/images/note.png" alt="note-icon">
            <input type="text" name="note" v-model="payload.note" placeholder="備註" required>


            <span></span>
            <p class="control-box">
                <button type="button" class="close" @click="closeDialog">取消</button>
                <button type="submit" class="submit">儲存</button>
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
    position: fixed;
    top: 50%;
    left: 50%;
    width: 700px;
    height: auto;
    line-height: 50px;


    border: 1px solid #ccc;
    border-radius: 30px;
    background-color: #fff;
    box-shadow: 0 0 30px #ddd;

    transition: 300ms;
    transform: translate(-50%, -50%) scale(0);

    z-index: 3;
    overflow-y: auto;

}

#dialog.show {
    transform: translate(-50%, -50%) scale(1);
}

#dialog::-webkit-scrollbar,
section.length::-webkit-scrollbar {
    width: 10px;
}

#dialog::-webkit-scrollbar-track,
section.length::-webkit-scrollbar {
    background-color: #f1f1f1;
}

#dialog::-webkit-scrollbar-thumb,
section.length::-webkit-scrollbar {
    background-color: #888;
    border-radius: 5px;
}

.newStudent {
    display: grid;
    grid-template-columns: 1fr 10fr;
    grid-gap: 20px;
    position: relative;
    justify-items: center;
    align-items: center;
    padding-right: 10px;
}

hr {
    margin: 20px 0;
}

section {
    width: 100%;
    display: grid;
    grid-template-columns: 1fr;
    grid-gap: 10px 25px;
    position: relative;
}

section.name {
    display: flex;
}

section.length {
    overflow-x: hidden;
    overflow-y: auto;
    height: 80px;
}

article {
    background-color: #eee;
    width: 70px;
    height: 30px;
    border-radius: 30px;
    display: flex;
    justify-content: space-between;
}

article button {
    width: 30px;
    height: 30px;
    padding: 0;
    margin: 0;
    font-size: 18px;
    border-radius: 50%;

    display: flex;
    justify-content: center;
    align-items: center;

    color: #777;
    box-shadow: none;
    border: none;
}

article button:hover {
    background: #ddd;
}

input {
    width: 100%;
    padding: 5px;
    margin: 0;
    border: none;
    border-bottom: 1px solid #ccc;
    outline: none;
}

select {
    margin: 0;
    padding: 5px;
    width: 90%;
}

input::placeholder {
    color: #bbb;
    font-size: 16px;
}

.avatar_preview {
    width: 50px;
    height: 50px;
    position: absolute;
    top: 0;
    left: 5px;
    opacity: 0;
}

.avatar {
    border-radius: 50%;
    width: 60px;
    height: 60px;
    object-fit: cover;
}

img[alt='phone-icon'],
img[alt='tag-icon'],
img[alt='note-icon'],
img[alt='email-icon'] {
    width: auto;
    zoom: 80%;
}

.control-box {
    margin-left: auto;
    display: flex;
}
</style>