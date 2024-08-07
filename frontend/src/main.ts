import { createApp } from "vue";
import { createPinia } from "pinia";

import PrimeVue from "primevue/config";
import Aura from "@primevue/themes/aura";

import ToastService from "primevue/toastservice";

import { router } from "./router";

import "./style.css";
import App from "./App.vue";

import "primeicons/primeicons.css";

const pinia = createPinia();
const app = createApp(App);

app.use(ToastService);
app.use(PrimeVue, {
  theme: {
    preset: Aura,
    options: {
      prefix: "p",
      darkModeSelector: '[data-mode="dark"]',
      cssLayer: false,
    },
  },
});

app.use(router);
app.use(pinia);
app.mount("#app");
