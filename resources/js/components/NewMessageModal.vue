<script setup>
import { onMounted, ref } from "vue";
import { useGlobalStore } from "../stores/global";

const emit = defineEmits(["close"]);

const props = defineProps({
  channels: Array,
});

const store = useGlobalStore();

const isOpen = ref(true);
const loading = ref(false);

const selectedChannel = ref("all");

function changeChannel(channel) {
  if(loading.value) return;

  selectedChannel.value = channel;

  store.changeLastChannel(channel);
}

function sendMessage() {
  try {
    loading.value = true;
    setTimeout(() => {

      loading.value = false
      emit('close')
    }, 3000)
  } catch (error) {

  } finally {
  }
}

onMounted(() => {
  if (props?.channels.includes(store.lastChannel)) {
    selectedChannel.value = store.lastChannel;
  }
});
</script>

<template>
  <transition name="fade">
    <div
      v-if="isOpen"
      class="new-message-modal fixed inset-0 flex items-center justify-center z-50"
    >
      <div
        class="new-message-modal__container bg-white rounded-lg shadow-lg w-11/12 max-w-md p-6 relative"
      >
        <h2 class="text-xl font-bold mb-4">Nova mensagem</h2>
        <p style="margin-bottom: 1rem">Selecione o provedor para ser enviado.</p>

        <div v-if="loading" class="spinner"></div>
        <div class="new-message-modal__channels" :class="{'new-message-modal__channels--disabled' : loading}">
          <div
            class="channels__item"
            v-for="channel in channels"
            :key="channel"
            :class="{ 'channels__item--selected': selectedChannel === channel }"
            :title="`Enviar mensagem pelo ${channel}!`"
            @click="changeChannel(channel)"
          >
            <img :src="`http://localhost:8000/images/channels/${channel}.svg`" alt="" />
          </div>
        </div>
        <select :disabled="loading" name="" id="" class="new-message-modal__contacts">
          <option value="" selected disabled>Selecione um contato...</option>
          <option value="">Contato 1</option>
          <option value="">Contato 2</option>
          <option value="">Contato 3</option>
        </select>

        <textarea
          :disabled="loading"
          name=""
          class="new-message-modal__message"
          id=""
          rows="4"
          placeholder="Escreva aqui sua mensagem..."
        />

        <!-- Ações -->
        <div style="gap: 1rem" class="flex justify-end space-x-2">
          <button
            @click="emit('close')"
            style="border: 2px solid #4d4d4d; background-color: #fff; color: #000"
            class="new-message-modal__button px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
            :disabled="loading"
          >
            Cancelar
          </button>
          <button @click="sendMessage()" :disabled="loading" class="new-message-modal__button" style="background-color: #4d4d4d">
            Confirmar
          </button>
        </div>
      </div>
    </div>
  </transition>
</template>

<style lang="scss">
.new-message-modal {
  background: #00000082;

  &__button {
    &:disabled {
      background-color: #d3d3d3!important;
      border: 0px!important;
      color: #FFF!important;
    }
  }

  &__contacts {
    margin-top: 1rem;
    display: block;
    height: 35px;
    background: #fff;
    border-radius: 4px;
    width: 450px;
    margin-bottom: 1rem;
    padding: 8px;
    font-size: 14px;
    border: 1px solid rgb(211, 211, 211);

    &:disabled {
      background-color: #d3d3d3;
    }
  }

  &__message {
    border-radius: 6px;
    width: 450px;
    margin-bottom: 1.5rem;
    background: #fff;
    border: 1px solid rgb(211, 211, 211);
    color: #000;
    padding: 8px;

    &:disabled {
      background-color: #d3d3d3;
    }
  }

  &__channels {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
    padding: 10px 17px;
    background: rgba(25, 178, 178, 0.7607843137);
    border-radius: 10px;

    &--disabled {
      background-color: #d3d3d3;
    }
  }

  &__container {
    background: #f8f8f8;
    border: 10px solid #19b2b2c2;
    padding: 20px;
    width: 100%;
    max-width: 600px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
}

.spinner {
  border: 8px solid #f3f3f3;
  border-top: 8px solid #19b2b2c2;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
