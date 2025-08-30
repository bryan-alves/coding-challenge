import { defineStore } from "pinia";
import { Inertia } from '@inertiajs/inertia';

export const useGlobalStore = defineStore("global", {
  state: () => ({
    selectedChannel: 'all',
    newMessageModal: false,
    selectedContact: 0,
    theme: localStorage.getItem("theme") || "light",
  }),
  actions: {
    changeChannel(selected) {
      this.selectedChannel = selected;
      Inertia.get('/', { channel: selected }, { preserveState: true });
    },
    toggleNewMessageModal(status) {
      this.newMessageModal = status;
    },
    changeContact(contactId) {
      this.selectedContact = contactId;
      Inertia.post('/read-message', { contact_id: contactId });
    },
    getChannelIcon(channel) {
      const components = {
        whatsapp: 'mdi:whatsapp',
        telegram: 'basil:telegram-outline',
        messenger: 'mingcute:messenger-line',
      };

      return components[channel];
    },
    setTheme(theme) {
      this.theme = theme
      localStorage.setItem("theme", theme)
      document.documentElement.setAttribute("data-theme", theme)
    },
    toggleTheme() {
      this.setTheme(this.theme === "light" ? "dark" : "light")
    }
  },
});
