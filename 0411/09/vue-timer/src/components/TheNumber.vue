<script setup>
import { computed } from "vue";

const props = defineProps({
  n: {
    type: Number,
  },
});

const data = [
  [0, 1, 2, 3, 4, 5],
  [1, 2],
  [0, 1, 3, 4, 6],
  [0, 1, 2, 3, 6],
  [1, 2, 5, 6],
  [0, 2, 3, 5, 6],
  [0, 2, 3, 4, 5, 6],
  [0, 1, 2],
  [0, 1, 2, 3, 4, 5, 6],
  [0, 1, 2, 3, 5, 6],
];

const targetData = computed(() => {
  return data[props.n];
});

const classes = [
  "top",
  "right-one",
  "right-two",
  "bottom",
  "left-two",
  "left-one",
  "center",
];
</script>

<template>
  <div class="box">
    <div
      v-for="(className, i) in classes"
      class="line"
      :class="[className, { active: targetData.includes(i) }]"
      :key="i"
    ></div>
  </div>
</template>

<style scoped>
.line {
  background-color: #db4c4c60;
  width: 150px;
  height: 20px;
  border-radius: 10px;
  position: absolute;
}

.active {
  background-color: #db4c4c;
}

.box {
  width: 160px;
  height: 320px;
  position: relative;
  margin: 20px 50px;
}

.right-one,
.right-two,
.left-one,
.left-two {
  width: 20px;
  height: 150px;
}

.right-one,
.right-two {
  right: -20px;
}

.right-one,
.left-one {
  top: 30px;
}

.right-two,
.left-two {
  bottom: -30px;
}

.bottom {
  bottom: -60px;
}

.left-one,
.left-two {
  left: -20px;
}

.center {
  bottom: 120px;
}
</style>
