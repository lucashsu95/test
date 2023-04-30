<script setup>
import { inject, ref, watch } from 'vue';
import TheDialog from './icons/TheDialog.vue';

const studentData = inject('studentData');

const toggleDialogSort = inject('toggleDialogSort');

const list = ref(
    [
        { key: "last_name", value: '姓名' },
        { key: 'student_id', value: '學號' },
        { key: 'email[0]', value: "電子郵件" },
    ]);

const direction = ref(['遞增', '遞減']);

const selectListIndex = ref(null);

const selectDicIndex = ref(0);

const onSubmit = () => {
    const order = list.value[selectListIndex.value].key;
    const sort = direction.value[selectDicIndex.value];
    studentData.value.sort((x, y) => sort === '遞增' ? (x[order] > y[order] ? 1 : -1) : (x[order] < y[order] ? 1 : -1));
    toggleDialogSort();
}

</script>

<template>
    <TheDialog flag="toggleDialogSort" :onSubmit="onSubmit">
        <template #header>排序</template>
        <template #other>
            項目:
            <ul @change="" class="list">
                <li v-for="item, index in list" :key=item.key @click="selectListIndex = index"
                    :class="{ active: index === selectListIndex }">
                    {{ item.value }}
                </li>
            </ul>

            排序方式:
            <ul>
                <li v-for="item, index in direction" :key="item" @click="selectDicIndex = index"
                    :class="{ active: index === selectDicIndex }">
                    {{ item }}
                </li>
            </ul>
        </template>
    </TheDialog>
</template>

<style scoped>
ul {
    display: flex;
    justify-content: center;
    align-items: center;
}

li {
    border: 1px solid #f90;
    border-radius: 5px;
    padding: 5px 20px;
    list-style: none;
    margin: 5px;
    cursor: pointer;
}

li:hover {
    color: #fff;
    background-color: #59f;
}

li.active {
    color: #fff;
    background-color: #39f;
}
</style>