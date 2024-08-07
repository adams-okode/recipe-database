<template>
  <div
    class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8"
  >
    <div>
      <nav class="flex" aria-label="Breadcrumb">
        <ol
          class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
        >
          <li class="inline-flex items-center">
            <a
              href="#"
              class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white"
            >
              <svg
                class="me-2.5 h-3 w-3"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"
                />
              </svg>
              Home
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <svg
                class="h-5 w-5 text-gray-400 rtl:rotate-180"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                fill="none"
                viewBox="0 0 24 24"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m9 5 7 7-7 7"
                />
              </svg>
              <a
                href="#"
                class="ms-1 text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white md:ms-2"
              >
                Recipes
              </a>
            </div>
          </li>
        </ol>
      </nav>
      <h2
        class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl"
      >
        Recipes
      </h2>
    </div>
    <div class="flex items-center space-x-4">
      <InputText
        v-model="searchQuery"
        @input="debouncedSearch"
        placeholder="Search Recipes..."
        class="p-inputtext-sm"
      />
      <Button
        label="Filters"
        icon="pi pi-filter"
        class="p-button-outlined"
        @click="showFilters = !showFilters"
        aria-expanded="showFilters"
      />
      <Dropdown
        v-if="showFilters"
        :options="filterOptions"
        optionLabel="label"
        optionValue="value"
        class="w-36"
        placeholder="Select a Filter"
        v-model="selectedFilter"
        @change="applyFilter"
      />
      <Dropdown
        :options="sortOptions"
        optionLabel="label"
        optionValue="value"
        class="w-36"
        placeholder="Sort by"
        v-model="selectedSort"
        @change="applySort"
      />
      <Button
        icon="pi pi-plus"
        as="router-link"
        label="New Recipe"
        to="/recipe"
        severity="success"
      />
    </div>
  </div>

  <div v-if="loading" class="flex justify-center my-8">
    <ProgressSpinner />
  </div>

  <div
    v-else
    class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4"
  >
    <template v-for="recipe in recipes.data" :key="recipe.id">
      <router-link :to="`/recipe/${recipe.id}`">
        <recipe-card :recipe="recipe"></recipe-card>
      </router-link>
    </template>
  </div>

  <div class="flex justify-center mt-4">
    <button
      @click="handlePageChange(recipes.prev_page_url ? currentPage - 1 : null)"
      :disabled="!recipes.prev_page_url"
      class="mx-1 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
    >
      < Previous
    </button>
    <button
      @click="handlePageChange(recipes.next_page_url ? currentPage + 1 : null)"
      :disabled="!recipes.next_page_url"
      class="mx-1 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
    >
      Next >
    </button>
  </div>
</template>

<script setup lang="ts">
import { onMounted, ref, Ref } from "vue";
import { listRecipes } from "../service/recipes";
import InputText from "primevue/inputtext";
import RecipeCard from "../components/RecipeCard.vue";
import Button from "primevue/button";
import Dropdown from "primevue/dropdown";
import ProgressSpinner from "primevue/progressspinner";
import { debounce } from "lodash";

import { Cuisine, RecipesResponse } from "../data";
import { listCuisines } from "../service/cuisines";

const recipes: Ref<RecipesResponse> = ref({} as RecipesResponse);
const currentPage = ref(1);

const loading = ref(false);
const showFilters = ref(false);
const searchQuery = ref<string | null>(null);
const selectedFilter = ref<string | null>(null);
const selectedSort = ref<string | null>(null);

const filterOptions = ref([]);

const sortOptions = [
  { label: "Newest", value: "created_at" },
  { label: "Oldest", value: "created_at_asc" },
  { label: "Name (A-Z)", value: "name" },
  { label: "Name (Z-A)", value: "name_desc" },
  { label: "Last Updated", value: "updated_at" },
];

const fetchRecipes = async (page = 1) => {
  try {
    loading.value = true;
    const sortParams = selectedSort.value?.split("_") || [];
    const { data } = await listRecipes({
      page,
      cuisineId: selectedFilter.value ? parseInt(selectedFilter.value) : null,
      search: searchQuery.value,
      sortBy: sortParams[0],
      sortDirection: sortParams[1] === "asc" ? "asc" : "desc",
    });
    recipes.value = data;
    currentPage.value = data.current_page;
  } catch (error) {
    console.error("Failed to fetch recipes:", error);
  } finally {
    loading.value = false;
  }
};

const handlePageChange = (page: number | null) => {
  if (page !== null && page >= 1 && page <= recipes.value.last_page) {
    fetchRecipes(page);
  }
};

const applyFilter = () => {
  fetchRecipes(currentPage.value);
};

const applySort = () => {
  fetchRecipes(currentPage.value);
};

const debouncedSearch = debounce(() => {
  fetchRecipes(currentPage.value);
}, 300);

onMounted(async () => {
  loading.value = true;
  try {
    const { data: cuisinesData } = await listCuisines();
    filterOptions.value = cuisinesData?.map((cuisine: Cuisine) => ({
      label: cuisine.name,
      value: cuisine.id,
    }));
    fetchRecipes();
  } catch (error) {
    console.error("Failed to fetch cuisines:", error);
  } finally {
    loading.value = false;
  }
});
</script>
