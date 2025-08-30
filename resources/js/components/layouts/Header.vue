<script setup>
import { useGlobalStore } from "@/stores/global";
import { Icon } from '@iconify/vue'

const store = useGlobalStore();
</script>

<template>
  <div class="header">
    <div class="header__logo">
      <img
        :src="`/images/logo-${store.theme}.svg`"
        alt=""
      />
    </div>
    <div class="header__new-message">
      <Icon :icon="'lucide:message-circle-plus'" width="22" height="22" :color="store.theme === 'light' ? '2B313B' : 'fff'" @click="store.toggleNewMessageModal(true)"/>
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

  &__logo {
    width: 230px;

    img {
      width: 100%;
      height: 100%;
    }
  }

  &__new-message {
    cursor: pointer;
  }
}
</style>
