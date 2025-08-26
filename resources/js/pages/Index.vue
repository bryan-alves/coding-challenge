<script setup>
import Header from "../components/Header.vue";
import Menu from "../components/Menu.vue";
import Container from "../components/Container.vue";
import Channels from "../components/Channels.vue";
import Contacts from "../components/Contacts.vue";

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
      <div class="content">
        <img src="https://pipelead.to/wp-content/uploads/2023/10/logo-pipeleads.svg" alt="" />
      </div>
    </Container>
  </div>
</template>

<style lang="css" scoped>
.content {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
}
</style>
