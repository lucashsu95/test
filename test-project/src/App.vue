<!-- a.vue -->
<template>
  <div>
    <c ref="childComponent"></c>
    <button @click="callChildMethod">调用子组件方法</button>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const childComponent = ref(null)

const components = {
  c: {
    template: `
      <div>
        <h2>我是子组件C</h2>
      </div>
    `,
    setup() {
      const childMethod = () => {
        console.log('子组件C的方法被调用了！')
      }
      return {
        childMethod
      }
    }
  }
}

</script>
