import { defineStore } from "pinia";
import { Inertia } from '@inertiajs/inertia';

export const useGlobalStore = defineStore("global", {
  state: () => ({
    selectedChannel: 'all',
    newMessageModal: false,
    selectedContact: 0,
    theme: localStorage.getItem("theme") || "light",
    messages: [],
    pollingInterval: null,
    messagesPage: 1,
    hasMoreMessages: true,
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
      this.fetchMessages(true);
      // this.startPolling();
    },
    fetchMessages(reset = false) {
      return new Promise((resolve) => {
        if (!this.selectedContact) return resolve();

        if (reset) {
          this.messagesPage = 1;
          this.hasMoreMessages = true;
          this.messages = [];
        }

        if (!this.hasMoreMessages) return resolve();

        Inertia.get(
          '/',
          { contact_id: this.selectedContact, page: this.messagesPage },
          {
            preserveState: true,
            replace: true,
            onSuccess: (page) => {
              const newMessages = page.props.messages.data.reverse();
              if (newMessages.length === 0) this.hasMoreMessages = false;

              this.messages = [...newMessages, ...this.messages];
              this.messagesPage++;
              resolve();
            }
          }
        );
      });
    },
    startPolling() {
      this.stopPolling();

      this.pollingInterval = setInterval(() => {
        this.fetchMessages();
      }, 5000);
    },
    stopPolling() {
      if (this.pollingInterval) {
        clearInterval(this.pollingInterval);
        this.pollingInterval = null;
      }
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
      this.theme = theme;
      localStorage.setItem("theme", theme);
      document.documentElement.setAttribute("data-theme", theme);
    },
    toggleTheme() {
      this.setTheme(this.theme === "light" ? "dark" : "light");
    }
  },
});
