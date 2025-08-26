<script setup>
defineProps({
  contacts: Array,
});
</script>

<template>
  <div class="contacts__container" :key="contact.id" v-for="contact in contacts">
    <div class="contacts__photo">
      <img :src="contact.photo" alt="" />
    </div>
    <div>
      <h6>
        {{ contact.name }}
        <span class="contacts__origin">({{ contact.channel }})</span>
      </h6>
      <div class="contacts__content">
        <p
          class="contacts__last-message"
          :style="contact.unread_message ? 'max-width: 232px;' : ''"
        >
          {{ contact.last_message }}
        </p>
        <div v-if="contact.unread_message" class="contacts__unread-message">
          <span>{{ contact.unread_message }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.contacts {
  &__container {
    padding: 10px;
    border-radius: 10px;
    background: #19b2b2c2;
    display: flex;
    gap: 0.75rem;
    margin-bottom: 0.25rem;

    &:hover {
      background: #d3d3d3 !important;
      cursor: pointer;
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
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: red;
    border-radius: 50%;
    width: 18px;
    height: 18px;
  }
}
</style>
