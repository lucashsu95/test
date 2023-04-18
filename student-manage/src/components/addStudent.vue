<script setup>
import { ref } from 'vue';

const image = ref(null);

const onUpload = (e) => {
    const file = e.target.files[0];
    const render = new FileReader();
    render.readAsDataURL(file);
    render.onload = () => {
        image.value = render.result;
    }
}

const onSubmit = () => {
    alert('儲存成功')
}

const props = defineProps({
    toggleDialog: {
        type: Boolean,
    }
})

</script>

<template>
    <div id="dialog" :class="{ show: toggleDialog }">

        <h1>新增學生</h1>
        <hr>
        <form class="newStudent">
            <p>
                大頭貼: <input type="file" class="avatar" @change="onUpload">
            </p>
            <p>
                <img :src="image" alt="圖片" class="avatar_preview">
            </p>
            <p>
                姓氏: <input type="text" name="last_name" id="">
            </p>
            <p>
                名字: <input type="text" name="first_name" id="">
            </p>
            <p>
                電子郵件: <input type="email" name="email" id="">
            </p>
            <p>
                電話: <input type="tel" name="phone[]" id="">
            </p>
            <p>
                地址: <input type="text" name="address" id="">
            </p>
            <p>
                學生班級:
                <select name="class" id="" class="class">
                    <option value="a">a</option>
                    <option value="b">b</option>
                </select>
            </p>
            <p>
                備註: <input type="text" name="note" id="">
            </p>
            <span></span>
            <button type="button" class="close" @click="toggleDialog = false">取消</button>
            <button type="button" class="submit" @click="onSubmit">儲存</button>

        </form>
    </div>
</template>

<style scoped>
#dialog {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    width: 600px;
    border: 1px solid #ccc;
    border-radius: 30px;
    padding: 25px;
    background-color: #fff;
    z-index: 3;
    transition: 300ms;
}

#dialog.show {
    transform: translate(-50%, -50%) scale(1);
}

.newStudent {
    display: grid;
    grid-template-columns: 1fr 1fr;
}

.newStudent p {
    display: grid;
    align-items: center;
    justify-items: center;
    grid-template-columns: 1fr 3fr;
}

.avatar_preview {
    text-align: center;
    width: 120px;
}

.avatar {
    width: 75%;
}
</style>