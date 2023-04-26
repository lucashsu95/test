<script setup>
import { inject } from 'vue';

const props = defineProps({
    flag: String,
})

const toggleDialog = inject(props.flag);

</script>

<template>
    <div id="dialog">
        <h2 class="title">
            <slot name="header"></slot>
        </h2>
        <hr>
        <div class="newStudent">
            <slot name="body">

            </slot>
        </div>
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
    z-index: 3;
}

.bg {
    width: 100vw;
    height: 100vh;
    position: absolute;
    top: 0;
    left: 0;

    background-color: #0000006d;
    z-index: 2;
}
</style>