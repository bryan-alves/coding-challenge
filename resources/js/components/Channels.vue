<script setup>
defineProps({
  channels: Array,
});
</script>

<template>
  <div class="">
    <div class="channels">
      <div class="channels__item" title="Veja todas as suas mensagens!">
        <img :src="`http://localhost:8000/images/channels/messages.svg`" alt="" />
      </div>
      <div style="display: flex; gap: 1rem">
        <div
          class="channels__item"
          :key="channel"
          v-for="channel in channels"
          :title="`Veja somente suas mensagens do ${channel}!`"
        >
          <img :src="`http://localhost:8000/images/channels/${channel}.svg`" alt="" />
        </div>
      </div>
      <div class="channels__item" title="Clique para enviar uma nova mensagem!">
        <img :src="`http://localhost:8000/images/channels/message-plus.svg`" alt="" />
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.channels {
  display: flex;
  justify-content: space-between;
  margin-bottom: 0.5rem;
  padding: 10px;
  background: #19b2b2c2;
  border-radius: 10px;

  &__item {
    width: 40px;
    cursor: pointer;
  }
}
</style>
