<script setup>
import ContactsCard from "../ui/ContactsCard.vue";

const props = defineProps({
  contacts: Array,
});
</script>

<template>
  <div class="contacts">
    <ContactsCard :key="contact.id" v-for="contact in contacts" :contact="contact" />
  </div>
</template>

<style lang="scss" scoped>
.contacts {
  overflow-y: scroll;
  max-height: calc(100% - 80px);
  margin-top: -8px;

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
