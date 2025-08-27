<script setup>
import { useGlobalStore } from "../stores/global";

defineProps({
  contacts: Array,
});

const store = useGlobalStore();
</script>

<template>
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
    <div>
      <h6 style="display: flex; align-items: center">
        {{ contact.name }}
        <span class="contacts__origin" style="margin-left: 4px; margin-right: 4px"
          >({{ contact.channel }})</span
        >&nbsp;
        <div v-if="contact.unread_message" class="contacts__unread-message">
          <span>{{ contact.unread_message }}</span>
        </div>
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
  </div>
</template>

<style lang="scss" scoped>
.contacts {
  &__container {
    padding: 10px;
    display: flex;
    gap: 0.75rem;
    margin-bottom: 0.25rem;
    border-bottom: 1px solid #d3d3d3;

    &:hover {
      background: #19b2b288 !important;

      cursor: pointer;
    }

    &--selected {
      background: #19b2b288 !important;
    }
  }

  &__photo {
    width: 48px;
    min-width: 48px;
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
    background: #d51717;
    border-radius: 50%;
    width: 16px;
    height: 16px;
    color: #fff;
    font-weight: 700;
  }
}
</style>
