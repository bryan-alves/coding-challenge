<script setup>
import Header from "../components/Header.vue";
import Menu from "../components/Menu.vue";
import Container from "../components/Container.vue";
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
    <Header />
    <Container>
      <Menu>
        <Channels :channels="channels" @openModal="store.toggleNewMessageModal(true)"/>
        <Contacts :contacts="contacts" />
      </Menu>
      <Content />
      <NewMessageModal v-if="store.newMessageModal" :channels="channels" @close="store.toggleNewMessageModal(false)"/>
    </Container>
  </div>
</template>
