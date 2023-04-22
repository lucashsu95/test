<script setup>
defineProps({
  class_name: String,
  num: Number,
});
</script>

<template>
  <span class="icon"><img src="../assets/images/tag.png" alt="123" /></span>
  {{ class_name }}
  <div class="num">
    {{ num }}
  </div>
</template>
