<script setup>
import { useGlobalStore } from "@/stores/global";
import ChannelsBadge from "@/components/ui/ChannelsBadge.vue";

const props = defineProps({
  contacts: Array,
});

const store = useGlobalStore();
</script>

<template>
  <div class="contacts">
    <div
      class="contacts__container"
      :class="{ 'contacts__container--selected': store.selectedContact === contact.id }"
      :key="contact.id"
      v-for="contact in contacts"
      @click="store.changeContact(contact.id)"
    >
      <div class="contacts__photo">
        <img :src="contact.photo" alt="" />
      </div>
      <div
        style="
          display: flex;
          align-items: center;
          justify-content: space-between;
          width: 100%;
        "
      >
        <div>
          <h6 style="display: flex; align-items: center; color: var(--primary-text-color); font-size: 18px">
            {{ contact.name }}&nbsp;&nbsp;
            <ChannelsBadge :channel="contact.channel.name" small onlyIcon />
          </h6>
          <div class="contacts__content">
            <p class="contacts__last-message">
              {{ contact.last_message?.message }}
            </p>
          </div>
        </div>
        <div v-if="contact.unread_messages_count" class="contacts__unread-message">
          <span>{{ contact.unread_messages_count }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.contacts {
  overflow-y: scroll;
  max-height: calc(100% - 80px);
  margin-top: -8px;

  p {
    color: var(--secondary-text-color);
  }

  &__container {
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

  &::-webkit-scrollbar {
    width: 4px;
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
</style>
