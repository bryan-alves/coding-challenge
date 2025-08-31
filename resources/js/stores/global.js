import { defineStore } from "pinia";
import { Inertia } from '@inertiajs/inertia';

export const useGlobalStore = defineStore("global", {
  state: () => ({
    selectedChannel: 'all',
    newMessageModal: false,
    selectedContact: 0,
    selectedContactName: '',
    selectedContactPhoto: '',
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
    changeContact(contactId, contactName, contactPhoto) {
      if (!contactId) {
        this.selectedContact = 0;
        this.selectedContactName = '';
        this.selectedContactPhoto = '';
        return
      };

      this.selectedContact = contactId;
      this.selectedContactName = contactName;
      this.selectedContactPhoto = contactPhoto;

      Inertia.post('/read-message',
        {
          contact_id: contactId
        },
        {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.fetchMessages(true, true);
          // this.startPolling();
        },
        onError: ({error}) => {
          alert(error)
        }
      });
    },
    async fetchMessages(reset = false, forPolling = false, forScrollTop = false) {
      if (!this.selectedContact) return;

      if (reset) {
        this.messagesPage = 1;
        this.hasMoreMessages = true;
        this.messages = [];
      }

      if (!this.hasMoreMessages && !forPolling) return;

      return new Promise((resolve) => {
        Inertia.get(
          '/',
          { contact_id: this.selectedContact, page: this.messagesPage },
          {
            preserveState: true,
            replace: true,
            onSuccess: (page) => {
              const newMessages = page.props.messages.data.reverse();

              if (forPolling) {
                const existingIds = this.messages.map(m => m.id);
                const messagesToAdd = newMessages.filter(m => !existingIds.includes(m.id));
                this.messages = [...this.messages, ...messagesToAdd];
              } else if (forScrollTop) {
                if (newMessages.length === 0) this.hasMoreMessages = false;
                this.messages = [...newMessages, ...this.messages];
                this.messagesPage++;
              } else if (reset) {
                this.messages = [...newMessages];
                this.messagesPage++;
              }

              resolve();
            }
          }
        );
      });
    },
    startPolling() {
      this.stopPolling();
      this.pollingInterval = setInterval(() => {
        this.fetchMessages(false, true);
      }, 5000);
    },
    stopPolling() {
      if (this.pollingInterval) {
        clearInterval(this.pollingInterval);
        this.pollingInterval = null;
      }
    },
    async sendMessage(message) {
      if (!this.selectedContact || !message) return;

      Inertia.post("/send-message", {
        contact_id: this.selectedContact,
        message,
      }, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.fetchMessages(true, true);
        },
        onError: ({error}) => {
          alert(error)
        }
      });
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
