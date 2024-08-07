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
        <p
          class="text-lg font-semibold leading-tight text-gray-900 truncate hover:text-clip hover:underline dark:text-white"
        >
          {{ recipe.name }}
        </p>
      </div>

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

defineProps<{
  recipe: Recipe;
}>();
</script>

<style scoped></style>
