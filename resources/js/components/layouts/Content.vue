<script setup>
import { useGlobalStore } from "@/stores/global";
import Chat from "../layouts/Chat.vue";
import ThemeToggle from "../ui/ThemeToggle.vue";

const store = useGlobalStore();
</script>

<template>
  <div class="content">
    <ThemeToggle />
    <div v-if="store.selectedContact" style="height: 100%">
      <Chat />
    </div>
    <div class="content__empty" v-else>
      <img
        :src="`/images/logo-${store.theme}.svg`"
        alt=""
      />
    </div>
  </div>
</template>

<style lang="scss" scoped>
.content {
  width: 100%;
  position: relative;
  background: var(--content-background-color);

  &__empty {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  input:focus {
    border-color: var(--border-color);
    outline: none;
  }
}
</style>
