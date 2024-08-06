<template>
  <div>
    <recipe-form :recipe="recipe" />
  </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { Recipe } from "../data";
import { getRecipe } from "../service/recipes";

import RecipeForm from "../components/RecipeForm.vue";

const recipe = ref<Recipe>({} as Recipe);

const route = useRoute(); // Access the current route

onMounted(async () => {
  const id = route.params.id as string; // Extract the 'id' from the route parameters
  if (id) {
    const { data } = await getRecipe(id);
    recipe.value = data; // Store the fetched recipe data in the ref
  }
});
</script>

<style scoped></style>
