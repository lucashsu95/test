<!-- <script setup>
import Laside from './components/Laside.vue';
import Lmain from './components/Lmain.vue';

</script>

<template>
  <Laside></Laside>
  <Lmain></Lmain>
</template> -->
<template>
  <div>
    <button @click="showModal = true">打开弹跳窗口</button>

    <div class="modal" v-if="showModal" @click.self="showModal = false">
      <div class="modal-content">
        <h2>弹跳窗口</h2>
        <p>这是一个简单的弹跳窗口示例</p>

        <div class="modal-actions">
          <button class="close" @click="showModal = false">取消</button>
          <button class="submit" @click="saveData">儲存</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showModal: false
    };
  },
  methods: {
    saveData() {
      // 在这里处理保存数据的逻辑
      console.log("保存数据");
    }
  }
};
</script>

<style>
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.modal-actions {
  display: flex;
  justify-content: flex-end;
  margin-top: 20px;
}

.close {
  margin-right: 10px;
}
</style>
