<template>
  <div
    class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800"
  >
    <div class="h-56 w-full">
      <a href="#">
        <img
          class="mx-auto h-full dark:hidden"
          :src="recipe.image_url"
          alt=""
        />
        <img
          class="mx-auto hidden h-full dark:block"
          :src="recipe.image_url"
          alt=""
        />
      </a>
    </div>
    <div class="p-6">
      <div class="mb-4 flex items-center justify-between gap-4">
        <div class="flex items-center justify-end gap-1">
          <button
            type="button"
            data-tooltip-target="tooltip-quick-look"
            class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          >
            <span class="sr-only"> Quick look </span>
            <svg
              class="h-5 w-5"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              fill="none"
              viewBox="0 0 24 24"
            >
              <path
                stroke="currentColor"
                stroke-width="2"
                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"
              />
              <path
                stroke="currentColor"
                stroke-width="2"
                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
              />
            </svg>
          </button>
          <div
            id="tooltip-quick-look"
            role="tooltip"
            class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
            data-popper-placement="top"
          >
            Quick look
            <div class="tooltip-arrow" data-popper-arrow=""></div>
          </div>

          <button
            type="button"
            data-tooltip-target="tooltip-add-to-favorites"
            class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          >
            <span class="sr-only"> Add to Favorites </span>
            <svg
              class="h-5 w-5"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"
              />
            </svg>
          </button>
          <div
            id="tooltip-add-to-favorites"
            role="tooltip"
            class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
            data-popper-placement="top"
          >
            Add to favorites
            <div class="tooltip-arrow" data-popper-arrow=""></div>
          </div>
        </div>
      </div>

      <a
        href="#"
        class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white"
        >{{ recipe.name }}</a
      >

      <div class="mt-2 flex items-center gap-2">
        <div class="flex items-center">
          <Chip :label="recipe.cuisine.name" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import type { Recipe } from "../data";
import Chip from "primevue/chip";

const props = defineProps<{
  recipe: Recipe;
}>();
</script>

<style scoped></style>
