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

<style scoped>
@reference "tailwindcss";

.contacts {
  @apply overflow-y-auto max-h-[calc(100%-80px)] -mt-2;
}

.contacts::-webkit-scrollbar {
  width: 4px;
}

.contacts::-webkit-scrollbar-track {
  background: var(--primary-gray-color);
}

.contacts::-webkit-scrollbar-thumb {
  background: var(--border-color);
  border-radius: 5px;
  width: 20px;
}
</style>
