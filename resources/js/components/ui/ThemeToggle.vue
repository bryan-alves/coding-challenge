<script setup>
import { useGlobalStore } from "@/stores/global";
import { onMounted, ref } from "vue";
import { Icon } from "@iconify/vue";

const store = useGlobalStore();

const status = ref("");

function setTheme() {
  if (status.value) {
    return store.setTheme("dark");
  }

  return store.setTheme("light");
}

onMounted(() => {
  if (store.theme) {
    status.value = store.theme;
  }
});
</script>

<template>
  <div class="theme-toggle">
    <input
      type="checkbox"
      class="theme-toggle__checkbox"
      id="theme-toggle-check"
      v-model="status"
      :checked="status === 'dark'"
      @change="setTheme"
    />
    <label class="theme-toggle__label" for="theme-toggle-check">
      <Icon icon="ri:moon-fill" width="14" height="14" color="f1c40f" />
      <Icon icon="noto-v1:sun" width="14" height="14" color="var(--white)" />
      <div class="theme-toggle__ball" :class="{'theme-toggle__ball--dark' : store.theme === 'dark'}"></div>
    </label>
  </div>
</template>

<style lang="scss" scoped>
.theme-toggle {
  position: absolute;
  right: 32px;
  top: 30px;

  &__checkbox {
    opacity: 0;
    position: absolute;
  }

  &__label {
    background-color: var(--primary-text-color);
    border-radius: 50px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 5px;
    position: relative;
    height: 22px;
    width: 42px;
    transform: scale(1.5);
  }

  &__ball {
    background-color: var(--white);
    border-radius: 50%;
    position: absolute;
    top: 2px;
    left: 2px;
    height: 18px;
    width: 18px;
    transform: translateX(0px);
    transition: transform 0.2s linear;

    &--dark {
      background-color: #000;
    }
  }

  &__checkbox:checked + &__label &__ball {
    transform: translateX(20px);
  }
}
</style>
