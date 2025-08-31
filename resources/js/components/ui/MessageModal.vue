<script setup>
import { onMounted, reactive, ref } from "vue";
import { useGlobalStore } from "@/stores/global";
import { Inertia } from "@inertiajs/inertia";
import ChannelsBadge from "@/components/ui/ChannelsBadge.vue";

const emit = defineEmits(["close"]);

const props = defineProps({
  channels: Array,
});

const store = useGlobalStore();

const isOpen = ref(true);
const loading = ref(false);

const formData = reactive({
  channel: "",
  message: "",
  contact_id: 1,
});

const contacts = ref([]);

function changeChannel(channel) {
  if (loading.value) return;

  formData.channel = channel;

  Inertia.get(
    "/",
    { modalChannel: channel },
    {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
      },
      onError: ({ error }) => {
        alert(error);
      },
    }
  );
}

function closeModal() {
  contacts.value = [];
  emit("close");
}

async function sendMessage() {
  loading.value = true;

  if (!formData.channel) {
    loading.value = false;
    return alert("Selecione o canal");
  }

  if (!formData.contact_id) {
    loading.value = false;
    return alert("Selecione o contato");
  }

  if (!formData.message) {
    loading.value = false;
    return alert("Preencha a mensagem");
  }

  await store.sendMessage(formData.message, formData.contact_id);

  formData.message = "";

  closeModal();

  store.changeContact(formData.contact_id);

  loading.value = false;
}

onMounted(() => {
  if (props?.channels.includes(store.selectedChannel)) {
    formData.channel = store.selectedChannel;
  }
});
</script>

<template>
  <transition name="fade">
    <div
      v-if="isOpen"
      class="message-modal fixed inset-0 flex items-center justify-center z-50"
    >
      <div
        class="message-modal__container bg-white rounded-lg shadow-lg w-11/12 max-w-md p-6 relative"
      >
        <h2 class="text-xl font-bold mb-4" style="color: var(--border-color)">
          Nova mensagem
        </h2>
        <p style="color: var(--secondary-text-color); margin-bottom: 0.5rem">
          Selecione o provedor para ser enviado.
        </p>

        <div v-if="loading" class="spinner"></div>
        <div class="message-modal__channels">
          <ChannelsBadge
            :channel="channel"
            v-for="channel in channels"
            :key="channel"
            :selected="formData.channel === channel"
            :title="`Veja suas mensagens do ${channel}!`"
            :disabled="loading"
            @click="changeChannel(channel)"
          />
        </div>
        <select
          :disabled="loading"
          name=""
          id=""
          class="message-modal__contacts"
          v-model="formData.contact_id"
        >
          <option value="" selected disabled>Selecione um contato...</option>
          <option :value="contact.id" v-for="contact in contacts">
            {{ contact.name }}
          </option>
        </select>

        <textarea
          :disabled="loading"
          name=""
          class="message-modal__message"
          id=""
          rows="4"
          placeholder="Escreva aqui sua mensagem..."
          v-model="formData.message"
        />

        <!-- Ações -->
        <div style="gap: 1rem" class="flex justify-end space-x-2">
          <button
            @click="closeModal"
            style="
              border: 1px solid var(--secondary-text-color);
              background-color: var(--white);
              color: var(--secondary-text-color);
            "
            class="message-modal__button px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
            :disabled="loading"
          >
            Cancelar
          </button>
          <button
            @click="sendMessage()"
            :disabled="loading"
            class="message-modal__button"
            style="background-color: var(--border-color)"
          >
            Confirmar
          </button>
        </div>
      </div>
    </div>
  </transition>
</template>

<style lang="scss">
.message-modal {
  background: var(--shadow-modal-color);

  &__button {
    &:disabled {
      background-color: var(--disabled-color) !important;
      border: 0px !important;
      color: var(--white) !important;
    }
  }

  &__contacts {
    color: var(--secondary-text-color);
    margin-top: 1rem;
    display: block;
    height: 35px;
    border-radius: 4px;
    width: 450px;
    margin-bottom: 1rem;
    padding: 8px;
    font-size: 14px;
    border: 1px solid var(--disabled-color);
    outline: 0;

    &:disabled {
      background-color: var(--disabled-color);
    }

    &:focus-visible {
      border-color: var(--border-color);
    }
  }

  &__message {
    color: var(--secondary-text-color);
    border-radius: 6px;
    font-size: 15px;
    width: 450px;
    margin-bottom: 1.5rem;
    border: 1px solid var(--disabled-color);
    padding: 8px;
    outline: none;

    &:disabled {
      background-color: var(--disabled-color);
    }

    &:focus-visible {
      border-color: var(--border-color);
    }
  }

  &__channels {
    display: flex;
    gap: 1rem;
    padding: 10px 17px;
    padding-bottom: 0px;
    border-radius: 10px;

    &--disabled {
      background-color: var(--disabled-color);
    }
  }

  &__container {
    background: var(--modal-background-color);
    padding: 20px;
    width: 100%;
    max-width: 600px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
}

.spinner {
  border: 8px solid var(--primary-gray-color);
  border-top: 8px solid var(--border-color);
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
