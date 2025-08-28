<script setup>
import { useGlobalStore } from "../stores/global";
import NewMessage from "./icons/NewMessage.vue";

const store = useGlobalStore();
</script>

<template>
  <div class="header">
    <div class="header__logo">
      <img
        src="https://pipelead.to/wp-content/uploads/2023/10/logo-pipeleads.svg"
        alt=""
      />
    </div>
    <div class="header__new-message">
      <NewMessage title="Nova mensagem!" @click="store.toggleNewMessageModal(true)"/>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  padding: 32px;
  background: #FCFCFD;
}
</style>
