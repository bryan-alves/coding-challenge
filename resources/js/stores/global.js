import { defineStore } from "pinia";

export const useGlobalStore = defineStore("global", {
  state: () => ({
    selectedChannel: 'all',
    newMessageModal: false,
    selectedContact: 0,
  }),
  actions: {
    changeChannel(selected) {
      this.selectedChannel = selected;
    },
    toggleNewMessageModal(status) {
      this.newMessageModal = status;
    },
    changeContact(contactId) {
      this.selectedContact = contactId;
    }
  },
});