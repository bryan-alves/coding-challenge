<script setup>
import { ref, onMounted, nextTick } from "vue";
import { Icon } from "@iconify/vue";
import ChatContent from "@/components/ui/ChatContent.vue";
import { useGlobalStore } from "@/stores/global";

const store = useGlobalStore();
const chatContentRef = ref(null);
let loadingOldMessages = false;

const onScroll = async () => {
  const el = chatContentRef.value;
  if (el.scrollTop === 0 && store.hasMoreMessages && !loadingOldMessages) {
    loadingOldMessages = true;

    const previousHeight = el.scrollHeight;

    await store.fetchMessages(false, false, true);

    nextTick(() => {
      el.scrollTop = el.scrollHeight - previousHeight;
      loadingOldMessages = false;
    });
  }
};

onMounted(async () => {
  await store.fetchMessages(true);
  nextTick(() => {
    chatContentRef.value.scrollTop = chatContentRef.value.scrollHeight;
  });
});
</script>


<template>
  <div class="chat" style="height: 100%">
    <div class="chat__header">
      <div class="chat__photo">
        <img src="/public/images/contacts/default.png" alt="" />
      </div>
      <h6 class="chat__contact">Nome</h6>
    </div>

    <div class="chat__content" ref="chatContentRef" @scroll="onScroll">
      <ChatContent :messages="store.messages" />
    </div>

    <div class="chat__bottom">
      <div class="chat__send">
        <input type="text" placeholder="Digite uma mensagem" />
        <div class="chat__btn">
          <Icon :icon="'material-symbols:send'" width="22" height="22" color="2B313B" />
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.chat {
  &__content {
    max-height: calc(100vh - 180px);
    height: 100%;
    overflow-y: scroll;
    padding: 32px;

    &::-webkit-scrollbar {
      width: 8px;
    }

    &::-webkit-scrollbar-track {
      background: var(--primary-gray-color);
    }

    &::-webkit-scrollbar-thumb {
      background: var(--border-color);
      border-radius: 5px;
      width: 20px;
    }
  }

  &__header {
    padding: 0px 32px;
    background: var(--chat-header-color);
    height: 80px;
    display: flex;
    align-items: center;
  }

  &__photo {
    width: 56px;
    min-width: 56px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 1rem;
  }

  &__contact {
    display: flex;
    align-items: center;
    color: var(--primary-text-color);
    font-size: 18px;
  }

  &__bottom {
    padding: 20px 32px;
  }

  &__send {
    height: 60px;
    padding: 10px 20px 10px 20px;
    background: var(--white);
    border-radius: 50px;
    display: flex;
    align-items: center;

    input {
      outline: 0;
      width: 100%;
      height: 100%;
    }
  }

  &__btn {
    cursor: pointer;
    background: var(--selected-background-color);
    height: 40px;
    width: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
  }
}
</style>
