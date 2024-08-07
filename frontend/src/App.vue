<template>
  <div class="">
    <Toast />
    <header-nav />
    <section class="bg-gray-50 py-4 antialiased dark:bg-gray-900 md:py-4">
      <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <router-view></router-view>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
import HeaderNav from "./components/HeaderNav.vue";

import Toast from "primevue/toast";
</script>

<style scoped></style>
