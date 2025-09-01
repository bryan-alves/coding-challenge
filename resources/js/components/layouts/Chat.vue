<script setup>
import { ref, onMounted, nextTick } from "vue";
import { Icon } from "@iconify/vue";
import ChatContent from "@/components/ui/ChatContent.vue";
import { useGlobalStore } from "@/stores/global";

const store = useGlobalStore();

const messageToSend = ref("");

const chatContentRef = ref(null);
let loadingOldMessages = false;

const onScroll = async () => {
  const el = chatContentRef.value;
  if (el.scrollTop < 10 && store.hasMoreMessages && !loadingOldMessages) {
    loadingOldMessages = true;

    const previousHeight = el.scrollHeight;

    await store.fetchMessages(false, false, true);

    nextTick(() => {
      el.scrollTop = el.scrollHeight - previousHeight;
      loadingOldMessages = false;
    });
  }
};

async function sendMessage() {
  if (!messageToSend.value) return;
  await store.sendMessage(messageToSend.value);
  messageToSend.value = "";
}

onMounted(async () => {
  await store.fetchMessages(true);
  nextTick(() => {
    chatContentRef.value.scrollTop = chatContentRef.value.scrollHeight;
  });
});
</script>

<template>
  <div class="chat">
    <div class="chat__header">
      <div class="chat__photo">
        <img :src="store.selectedContactPhoto" alt="" />
      </div>
      <h6 class="chat__contact">{{ store.selectedContactName }}</h6>
    </div>

    <div class="chat__content" ref="chatContentRef" @scroll="onScroll">
      <ChatContent :messages="store.messages" />
    </div>

    <div class="chat__bottom">
      <div class="chat__send">
        <input
          type="text"
          placeholder="Digite uma mensagem"
          v-model="messageToSend"
          @keyup.enter="sendMessage"
        />
        <div class="chat__btn" @click="sendMessage">
          <Icon :icon="'material-symbols:send'" width="22" height="22" color="2B313B" />
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
@reference "tailwindcss";

.chat {
  @apply h-full;
}

.chat__content {
  @apply h-full overflow-y-auto p-8 max-h-[calc(100vh-180px)];
}

.chat__content::-webkit-scrollbar {
  width: 8px;
}

.chat__content::-webkit-scrollbar-track {
  background: var(--primary-gray-color);
}

.chat__content::-webkit-scrollbar-thumb {
  background: var(--border-color);
  border-radius: 5px;
  width: 20px;
}

.chat__header {
  @apply flex items-center h-20 px-8;
  background: var(--chat-header-color);
}

.chat__photo {
  @apply w-14 min-w-14 rounded-full overflow-hidden mr-4;
}

.chat__contact {
  @apply flex items-center text-lg;
  color: var(--primary-text-color);
}

.chat__bottom {
  @apply px-8 py-5;
}

.chat__send {
  @apply flex items-center h-[60px] px-5 py-2.5 rounded-[50px];
  background: var(--white);
}

.chat__send input {
  @apply w-full h-full outline-0;
}

.chat__btn {
  @apply flex items-center justify-center h-10 w-10 rounded-full cursor-pointer;
  background: var(--selected-background-color);
}
</style>
