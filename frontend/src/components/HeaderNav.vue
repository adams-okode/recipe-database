<template>
  <header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
      <div
        class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl"
      >
        <a href="/" class="flex items-center">
          <img
            src="https://flowbite.com/docs/images/logo.svg"
            class="mr-3 h-6 sm:h-9"
            alt="Flowbite Logo"
          />
          <span
            class="self-center text-xl font-semibold whitespace-nowrap dark:text-white"
            >Flowbite</span
          >
        </a>
        <div class="flex items-center lg:order-2">
          <!-- Dark Mode Toggle Button -->
          <button
            @click="toggleDarkMode"
            class="focus:outline-none focus:ring-2 focus:ring-gray-200 rounded-full text-gray-700 dark:text-gray-300"
            aria-label="Toggle Dark Mode"
          >
            <span v-if="isDark" class="pi pi-sun text-2xl"></span>
            <span v-else class="pi pi-moon text-2xl"></span>
          </button>
        </div>
        <div
          class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1"
          id="mobile-menu-2"
        >
          <ul
            class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0"
          >
            <li>
              <a
                href="#"
                class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white"
                aria-current="page"
                >Home</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>

<script setup lang="ts">
import { computed } from "vue";
import { useColorMode } from "@vueuse/core";

// Use VueUse's useColorMode with custom selector
const colorMode = useColorMode({
  selector: "html", // The element to apply the attribute
  attribute: "data-mode", // The attribute to use
  modes: {
    dark: "dark", // Set the dark mode value
    light: "light", // Set the light mode value
  },
});

// Computed property to check if the current mode is dark
const isDark = computed(() => colorMode.value === "dark");

// Function to toggle dark mode
const toggleDarkMode = () => {
  colorMode.value = isDark.value ? "light" : "dark";
};
</script>

<style scoped></style>
