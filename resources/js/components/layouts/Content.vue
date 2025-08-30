<script setup>
import { useGlobalStore } from "@/stores/global";
import Chat from "../layouts/Chat.vue";

const store = useGlobalStore();
</script>

<template>
  <div class="content">
    <div v-if="store.selectedContact" style="height: 100%">
      <Chat />
    </div>
    <div class="content__empty" v-else>
      <img
        src="https://pipelead.to/wp-content/uploads/2023/10/logo-pipeleads.svg"
        alt=""
      />
    </div>
  </div>
</template>

<style lang="scss" scoped>
.content {
  width: 100%;
  background: radial-gradient(51.15% 49.94% at 50% 50.06%, #fcfcfd 33.65%, #f2f9f8 100%);

  &__empty {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  input:focus {
    border-color: #19b2b2c2;
    outline: none;
  }
}
</style>
