<script setup>
import { useGlobalStore } from "@/stores/global";
import ChannelsBadge from "./ChannelsBadge.vue";

const store = useGlobalStore();

const props = defineProps({
  contact: {
    type: Object,
  },
});

function formateDate(param) {
  if (!param) return;
  const date = new Date(param);

  return `${date.toLocaleDateString("pt-BR")} ${date.toLocaleTimeString("pt-BR", {
    hour: "2-digit",
    minute: "2-digit",
  })}`;
}
</script>

<template>
  <div
    class="contacts-card"
    :class="{ 'contacts-card--selected': store.selectedContact === contact.id }"
    @click="store.changeContact(contact.id, contact.name, contact.photo)"
  >
    <div class="contacts-card__photo">
      <img :src="contact.photo" alt="" />
    </div>
    <div class="contacts-card__container">
      <div class="contacts-card__body">
        <div class="contacts-card__header">
          <div class="contacts-card__title">
            <h6>{{ contact.name }}&nbsp;&nbsp;</h6>
            <ChannelsBadge :channel="contact.channel.name" small onlyIcon />
          </div>
          <span class="contacts-card__date">
            {{ formateDate(contact.last_message?.created_at) }}
          </span>
        </div>
        <div class="contacts-card__content">
          <p class="contacts-card__last-message">
            {{ contact.last_message?.message }}
          </p>
        </div>
      </div>
      <div v-if="contact.unread_messages_count" class="contacts-card__unread-message">
        <span>{{ contact.unread_messages_count }}</span>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.contacts-card {
  p {
    color: var(--secondary-text-color);
  }

  display: flex;
  gap: 0.75rem;
  padding: 10px 32px;

  &:hover {
    background: var(--contact-hover-color);
    cursor: pointer;
  }

  &--selected {
    background: var(--contact-hover-color) !important;
  }

  &__container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
  }

  &__title {
    display: flex;
    align-items: center;

    h6 {
      color: var(--primary-text-color);
      font-size: 18px;
    }
  }

  &__body {
    width: 100%;
  }

  &__photo {
    width: 56px;
    min-width: 56px;
    border-radius: 50%;
    overflow: hidden;
  }

  &__content {
    display: flex;
    align-items: center;
  }

  &__header {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  &__date {
    font-size: 12px;
    color: var(--secondary-text-color);
  }

  &__last-message {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 340px;
  }

  &__unread-message {
    font-size: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--unread-message-color);

    border-radius: 50%;
    width: 20px;
    height: 20px;
    color: var(--white);
    font-weight: 700;
  }
}
</style>
