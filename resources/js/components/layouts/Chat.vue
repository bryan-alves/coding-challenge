<script setup>
import { Icon } from "@iconify/vue";
import ChatContent from "@/components/ui/ChatContent.vue";
</script>

<template>
  <div class="chat" style="height: 100%">
    <div class="chat__header">
      <div class="chat__photo">
        <img src="/public/images/contacts/default.png" alt="" />
      </div>
      <h6 class="chat__contact">Nome</h6>
    </div>
    <div class="chat__content">
      <ChatContent />
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
    height: calc(100% - 200px);
    padding: 32px;
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
