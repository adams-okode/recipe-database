import { createRouter, createWebHashHistory } from "vue-router";

import HomePage from "./pages/HomePage.vue";
import RecipePage from "./pages/RecipePage.vue";
import CreateRecipePage from "./pages/CreateRecipePage.vue";

const routes = [
  { path: "/", component: HomePage },
  { path: "/recipe", component: CreateRecipePage },
  { path: "/recipe/:id", component: RecipePage },
];

export const router = createRouter({
  history: createWebHashHistory(),
  routes,
});
