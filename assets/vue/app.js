import { createApp } from "vue";

const app = createApp({
    data: () => ({
        modalOpen: true  
      }),
      methods: {
        toggleModalState() {
          this.modalOpen = !this.modalOpen;
        }
      }
});

app.mount("#app");