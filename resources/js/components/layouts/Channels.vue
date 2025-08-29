<script setup>
import { useGlobalStore } from "@/stores/global";
import ChannelsBadge from "@/components/ui/ChannelsBadge.vue";

defineProps({
  channels: Array,
});

const store = useGlobalStore();
</script>

<template>
  <div class="channels">
    <div class="channels__container">
      <div
        class="channels__item"
        :class="{ 'channels__item--selected': store.selectedChannel === 'all' }"
        title="Veja todas as suas mensagens!"
        @click="store.changeChannel('all')"
      >
        <span style="font-size: 14px">Todas</span>
      </div>
      <ChannelsBadge
        :channel="channel"
        v-for="channel in channels"
        :key="channel"
        :selected="store.selectedChannel === channel"
        :title="`Veja suas mensagens do ${channel}!`"
        @click="store.changeChannel(channel)"
      />
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
  overflow-x: auto;
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
    align-items: center;

    span {
      font-size: 14px;
      color: #556377;
    }

    &--selected {
      background: #acdbd3;
      border: 1px solid #86cec2;
      color: #0c6f64;
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
