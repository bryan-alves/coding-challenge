<script setup>
import { useGlobalStore } from "@/stores/global";
import ChannelsBadge from "@/components/ui/ChannelsBadge.vue";

defineProps({
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
          <h6 style="display: flex; align-items: center; color: #2b313b; font-size: 18px">
            {{ contact.name }}&nbsp;&nbsp;
            <ChannelsBadge :channel="contact.channel" small onlyIcon />
          </h6>
          <div class="contacts__content">
            <p
              class="contacts__last-message"
              :style="contact.unread_message ? 'max-width: 232px;' : ''"
            >
              {{ contact.last_message }}
            </p>
          </div>
        </div>
        <div v-if="contact.unread_message" class="contacts__unread-message">
          <span>{{ contact.unread_message }}</span>
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
    color: #556377;
  }

  &__container {
    display: flex;
    gap: 0.75rem;
    padding: 10px 32px;

    &:hover {
      background: #f2f2f2;
      cursor: pointer;
    }

    &--selected {
      background: #f2f2f2 !important;
    }
  }

  &__photo {
    width: 56px;
    min-width: 56px;
    border-radius: 50%;
    overflow: hidden;
  }

  &__origin {
    font-size: 12px;
    font-weight: 500;
    color: #747474;
  }

  &__content {
    display: flex;
    align-items: center;
  }

  &__last-message {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 250px;
  }

  &__unread-message {
    font-size: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #14b8a6;

    border-radius: 50%;
    width: 20px;
    height: 20px;
    color: #fff;
    font-weight: 700;
  }

  &::-webkit-scrollbar {
    width: 4px;
  }

  &::-webkit-scrollbar-track {
    background: #ebecee;
  }

  &::-webkit-scrollbar-thumb {
    background: #119d8e;
    border-radius: 5px;
    width: 20px;
  }

  &::-webkit-scrollbar-thumb:hover {
    background: #363636;
  }
}
</style>
