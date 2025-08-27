import { defineStore } from "pinia";

export const useGlobalStore = defineStore("global", {
  state: () => ({
    lastChannel: 'all',
    selectedChannel: 'all',
    newMessageModal: false,
    selectedContact: 0,
  }),
  actions: {
    changeChannel(selected) {
      this.lastChannel = this.selectedChannel;
      this.selectedChannel = selected;
      this.changeContact(0);
    },
    changeLastChannel(selected) {
      this.lastChannel = selected;
    },
    toggleNewMessageModal(status) {
      this.newMessageModal = status;

      if (!status) {
        this.selectedChannel = this.lastChannel;
      }
    },
    changeContact(contactId) {
      this.selectedContact = contactId;
    }
  },
});