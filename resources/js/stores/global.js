import { defineStore } from "pinia";

export const useGlobalStore = defineStore("global", {
  state: () => ({
    lastChannel: 'all',
    selectedChannel: 'all',
  }),
  actions: {
    changeChannel(selected) {
      this.lastChannel = this.selectedChannel;
      this.selectedChannel = selected;
    },
    toggleNewMessageModal(status) {
      this.newMessageModal = status;

      if (!status) {
        this.selectedChannel = this.lastChannel;
      }
    }
  },
});