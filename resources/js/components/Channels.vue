<script setup>
import { useGlobalStore } from "../stores/global";
import Whatsapp from "./icons/Whatsapp.vue";
import Telegram from "./icons/Telegram.vue";
import Messenger from "./icons/Messenger.vue";

defineProps({
  channels: Array,
});

const store = useGlobalStore();

function getComponent(channel) {
  const components = {
    Whatsapp,
    Telegram,
    Messenger,
  };

  return components[channel];
}
</script>

<template>
  <div class="channels">
    <div class="channels__container">
      <div
        class="channels__item channels__item--start"
        :class="{ 'channels__item--selected': store.selectedChannel === 'all' }"
        title="Veja todas as suas mensagens!"
        @click="store.changeChannel('all')"
      >
        Todas
      </div>
      <div
        class="channels__item"
        v-for="channel in channels"
        :key="channel"
        :class="{ 'channels__item--selected': store.selectedChannel === channel }"
        :title="`Veja suas mensagens do ${channel}!`"
        @click="store.changeChannel(channel)"
      >
        <component :is="getComponent(channel)" />
        <span>{{ channel }}</span>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.channels {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 0.5rem;
  padding: 0px 30px 10px;
  border-radius: 10px;
  overflow-x: scroll;
  overflow-y: hidden;

  &__container {
    display: flex;
    gap: 0.5rem;
    padding-right: 55px;
  }

  &__item {
    padding: 8px 12px;
    cursor: pointer;
    display: flex;
    border: 1px solid #ebecee;
    border-radius: 100px;
    min-width: fit-content;
    gap: 0.5rem;

    &--selected {
      background: #acdbd3;
      border: 1px solid #86cec2;
      color: #0c6f64;
    }

    &--start.channels__item--selected::after {
      left: -7px;
      top: -7px;
    }

    &--new {
      width: 40px;
    }

    &--new.channels__item--selected::after {
      left: -5px;
      top: -5px;
    }
  }

  &::-webkit-scrollbar {
    height: 4px;
  }

  &::-webkit-scrollbar-track {
    background: #ebecee;
  }

  &::-webkit-scrollbar-thumb {
    background: #119d8e;
    border-radius: 5px;
    width: 20px;
  }

  &::-webkit-scrollbar-thumb:hover {
    background: #363636;
  }
}

// background: var(--background-tertiary, #ebecee);
</style>
