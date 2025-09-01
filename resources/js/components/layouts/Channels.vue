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
      <ChannelsBadge
        channel="all"
        :selected="store.selectedChannel === 'all'"
        title="Veja todas as suas mensagens!"
        @click="store.changeChannel('all')"
      />
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

<style scoped>
@reference "tailwindcss";

.channels {
  @apply relative flex items-center justify-between mb-2 px-[30px] pb-[10px] rounded-[10px] overflow-x-auto overflow-y-hidden;
}

.channels__container {
  @apply flex gap-2 pr-[55px];
}

.channels__item {
  @apply flex items-center gap-2 px-3 py-2 cursor-pointer border rounded-full min-w-fit;
  border-color: var(--primary-gray-color);
}

.channels__item span {
  @apply text-sm;
  color: var(--secondary-text-color);
}

.channels__item--selected {
  @apply border;
  background: var(--selected-background-color);
  border-color: var(--border-color);
}

.channels__item--selected span {
  color: var(--selected-channel-color);
}

.channels::-webkit-scrollbar {
  height: 4px;
}

.channels::-webkit-scrollbar-track {
  background: var(--primary-gray-color);
}

.channels::-webkit-scrollbar-thumb {
  background: var(--border-color);
  border-radius: 5px;
  width: 20px;
}
</style>
