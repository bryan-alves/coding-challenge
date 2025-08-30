<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import Header from "@/components/layouts/Header.vue";
import Sidebar from "@/components/layouts/Sidebar.vue";
import Container from "@/components/layouts/Container.vue";
import Channels from "@/components/layouts/Channels.vue";
import Contacts from "@/components/layouts/Contacts.vue";
import MessageModal from "@/components/ui/MessageModal.vue"
import Content from "@/components/layouts/Content.vue";

import { useGlobalStore } from "@/stores/global";

const props = defineProps({
  contacts: Array,
  channels: Array,
});

const store = useGlobalStore();
</script>

<template>
  <div>
    <Head>
      <title>{{ 'Pipechat' }}</title>
      <link rel="icon" href="/images/logo.png" />
    </Head>
    <Container>
      <Sidebar>
        <Header />
        <Channels :channels="channels" @openModal="store.toggleNewMessageModal(true)"/>
        <Contacts :contacts="contacts" />
      </Sidebar>
      <Content />
      <MessageModal v-if="store.newMessageModal" :channels="channels" @close="store.toggleNewMessageModal(false)"/>
    </Container>
  </div>
</template>
