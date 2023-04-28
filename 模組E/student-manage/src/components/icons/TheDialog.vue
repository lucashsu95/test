<script setup>
import { inject } from 'vue';

const props = defineProps({
    flag: String,
    payload: Object,
    onSubmit: Function,

    emailLength: Number,
    phoneLength: Number,
    onUpload: Function,
})

const toggleDialog = inject(props.flag);

const classData = inject('classData');

</script>

<template>
    <div id="dialog">
        <h2 class="title">
            <slot name="header"></slot>
        </h2>
        <hr>
        <form class="newStudent" @submit.prevent="onSubmit">
            <template v-if="flag == 'toggleDialogStudent'">
                <p>
                    <label for="avatar">
                        <img :src="payload.avatar" alt="avatar" class="avatar_preview">
                    </label>
                    <input type="file" accept=".jpeg,.jpg,.png" class="avatar" id="avatar" @change="onUpload">

                    <i>
                        <input type="text" name="first_name" v-model="payload.first_name" placeholder="名字" required>
                        <input type="text" name="last_name" v-model="payload.last_name" placeholder="姓氏" required>
                    </i>
                </p>
                <p>
                    <img src="/src/assets/images/email.png" alt="" class="icon">
                    <i>
                        <input v-for="i in emailLength" type="email" name="email[]" v-model="payload.email[i - 1]"
                            placeholder="電子郵件">
                        <button class="add" type="button" @click="emailLength++">+</button>
                    </i>
                </p>
                <p>
                    <img src="/src/assets/images/home.png" alt="" class="icon">
                    <input type="address" name="address" id="" placeholder="地址" v-model="payload.address">
                </p>
                <p>
                    <img src="/src/assets/images/phone.png" alt="phone" class="icon">
                    <i>
                        <input v-for="i in phoneLength" type="tel" name="phone[]" v-model="payload.phone[i - 1]"
                            placeholder="電話號碼">
                        <button class="add" type="button" @click="phoneLength++">+</button>
                    </i>
                </p>
                <p>
                    <img src="/src/assets/images/tag.png" alt="" class="icon">
                    <select name="class" id="" v-model="payload.class">
                        <option value="請選擇班級" selected disabled>請選擇班級</option>
                        <option v-for="data in classData" :value="data.class_name">{{ data.class_name }}</option>
                    </select>
                </p>
                <p>
                    <img src="/src/assets/images/note.png" alt="phone" class="icon">
                    <input type="text" name="note" id="" placeholder="備註" v-model="payload.note">
                </p>
            </template>

            <template v-if="flag == 'toggleDialogClass'">
                <input type="text" name="name" placeholder="請輸入班級名稱" v-model="payload.class_name" required>
            </template>
            <slot name="other"></slot>

            <div class="control">
                <button type="reset" @click="toggleDialog" class="close">取消</button>
                <button v-show="flag !== 'toggleDialogImport' && flag !== 'toggleDialogExport'" class="submit">儲存</button>
                <slot name="other-btn"></slot>
            </div>
        </form>
    </div>
    <div class="bg" @click="toggleDialog"></div>
</template>

<style>
#dialog {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 600px;
    height: 500px;
    background-color: #fff;
    box-shadow: 2px 2px 30px #aaa;
    border: 1px solid #ccc;
    transform: translate(-50%, -50%);
    padding: 25px;
    line-height: 35px;
    border-radius: 30px;
    z-index: 4;
}

input {
    border: none;
    border-bottom: 1px solid #ccc;
    outline: none;
    width: 100%;
    height: 30px;
}

.bg {
    width: 100vw;
    height: 100vh;
    position: absolute;
    top: 0;
    left: 0;

    background-color: #0000006d;
    z-index: 3;
}

.control {
    margin-top: auto;
    display: flex;
    justify-content: end;
}

button {
    padding: 10px 25px;
    margin: 5px;
    border: 0;
    border-radius: 25px;
    color: #39f;
    background-color: #fff;
    cursor: pointer;
    transition: .5s;
    font-size: 18px;
}

button:hover {
    color: #fff;
    background-color: #39f;
}

.newStudent {
    position: relative;
    display: grid;
    grid-auto-rows: 1fr;
    height: 95%;
    width: 100%;
    padding: 25px 5px;
}

p {
    display: grid;
    grid-template-columns: 1fr 7fr;
    align-items: center;
    justify-items: center;
    grid-gap: 10px;
}

i {
    width: 100%;
    height: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    justify-items: center;
    grid-gap: 0 15px;
}

.content-icon {
    display: grid;
    grid-template-columns: 7fr 1fr;
    justify-items: center;
    align-items: center;
}

.avatar {
    display: none;
}

.icon {
    width: 35px;
}

img[alt='phone'] {
    zoom: 60%;
}

.avatar_preview {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 50%;
}

.add {
    zoom: 65%;
}
</style>