import { defineStore } from "pinia";

export const useGlobalStore = defineStore("global", {
  state: () => ({
    lastChannel: 'all',
    selectedChannel: 'all',
    newMessageModal: false,
  }),
  actions: {
    changeChannel(selected) {
      this.lastChannel = this.selectedChannel;
      this.selectedChannel = selected;
    },
    changeLastChannel(selected) {
      this.lastChannel = selected;
    },
    toggleNewMessageModal(status) {
      this.newMessageModal = status;

      if (!status) {
        this.selectedChannel = this.lastChannel;
      }
    }
  },
});