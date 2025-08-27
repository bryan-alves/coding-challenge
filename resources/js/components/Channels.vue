<script setup>
import { useGlobalStore } from "../stores/global";

const emit = defineEmits(["openModal"]);

defineProps({
  channels: Array,
});

const store = useGlobalStore();

function openModal() {
  emit("openModal");
}
</script>

<template>
  <div class="channels">
    <div style="display: flex; gap: 1rem">
      <div
        class="channels__item channels__item--start"
        :class="{ 'channels__item--selected': store.selectedChannel === 'all' }"
        title="Veja todas as suas mensagens!"
        @click="store.changeChannel('all')"
      >
        <img :src="`http://localhost:8000/images/channels/messages.svg`" alt="" />
      </div>
      <div
        class="channels__item"
        v-for="channel in channels"
        :key="channel"
        :class="{ 'channels__item--selected': store.selectedChannel === channel }"
        :title="`Veja suas mensagens do ${channel}!`"
        @click="store.changeChannel(channel)"
      >
        <img :src="`http://localhost:8000/images/channels/${channel}.svg`" alt="" />
      </div>
    </div>
    <div
      class="channels__item channels__item--new"
      :class="{ 'channels__item--selected': store.selectedChannel === 'new' }"
      title="Clique para enviar uma nova mensagem!"
      @click="
        store.changeChannel('new');
        openModal();
      "
    >
      <img
        class=""
        :src="`http://localhost:8000/images/channels/message-plus.svg`"
        alt=""
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
  padding: 10px 17px;
  background: #19b2b2c2;
  border-radius: 10px;

  &__item {
    width: 35px;
    cursor: pointer;
    z-index: 1;
    position: relative;
    display: flex;
    img {
      position: relative;
    }

    &--selected::after {
      content: "";
      position: absolute;
      height: 50px;
      width: 50px;
      // background-color: #e4e4e4;
      background-color: #4d4d4d;
      border-radius: 50%;
      top: -7px;
      left: -7px;
      z-index: -1;
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
}
</style>
