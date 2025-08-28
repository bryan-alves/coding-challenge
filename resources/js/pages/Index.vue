<script setup>
import Header from "../components/layouts/Header.vue";
import Sidebar from "../components/layouts/Sidebar.vue";
import Container from "../components/layouts/Container.vue";
import Channels from "../components/Channels.vue";
import Contacts from "../components/Contacts.vue";
import NewMessageModal from "../components/NewMessageModal.vue"
import Content from "../components/layouts/Content.vue";

import { useGlobalStore } from "../stores/global";

const props = defineProps({
  contacts: Array,
  channels: Array,
});

const store = useGlobalStore();
</script>

<template>
  <div>
    <Container>
      <Sidebar>
        <Header />
        <Channels :channels="channels" @openModal="store.toggleNewMessageModal(true)"/>
        <Contacts :contacts="contacts" />
      </Sidebar>
      <Content />
      <NewMessageModal v-if="store.newMessageModal" :channels="channels" @close="store.toggleNewMessageModal(false)"/>
    </Container>
  </div>
</template>
