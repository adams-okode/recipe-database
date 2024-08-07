<template>
  <div
    class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-900"
  >
    <h1 class="text-3xl font-bold text-center mb-8">{{ mode }} Recipe</h1>
    <form @submit.prevent="submitRecipe" class="space-y-6">
      <!-- Recipe Name -->
      <div class="form-field">
        <label for="name" class="block text-sm font-medium text-gray-700">
          Recipe Name
        </label>
        <InputText
          v-model="formData.name"
          id="name"
          placeholder="Enter recipe name"
          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          required
        />
      </div>

      <!-- Cuisine ID -->
      <div class="form-field">
        <label for="cuisine" class="block text-sm font-medium text-gray-700">
          Cuisine ID
        </label>
        <InputText
          v-model="formData.cuisine_id"
          id="cuisine"
          placeholder="Enter cuisine ID"
          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          required
        />
      </div>

      <!-- Instructions -->
      <div class="form-field">
        <label
          for="instructions"
          class="block text-sm font-medium text-gray-700"
        >
          Instructions
        </label>
        <Textarea
          v-model="formData.instructions"
          id="instructions"
          placeholder="Enter instructions"
          rows="5"
          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          required
        />
      </div>

      <!-- Ingredients -->
      <div class="form-field">
        <label class="block text-sm font-medium text-gray-700">
          Ingredients
        </label>
        <div
          v-for="(ingredient, index) in formData.ingredients"
          :key="ingredient.id || index"
          class="mb-4"
        >
          <div class="ingredient-item flex space-x-2">
            <InputText
              v-model="ingredient.name"
              placeholder="Ingredient name"
              class="flex-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              required
            />
            <InputText
              v-model="ingredient.quantity"
              placeholder="Quantity"
              class="flex-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              required
            />
            <Button
              icon="pi pi-trash"
              class="p-button-rounded p-button-danger p-2"
              @click="removeIngredient(index)"
            />
          </div>
        </div>
        <Button
          label="Add Ingredient"
          icon="pi pi-plus"
          class="p-button-sm mt-2"
          @click="addIngredient"
        />
      </div>

      <!-- Image Upload -->
      <div class="form-field">
        <label for="image" class="block text-sm font-medium text-gray-700">
          Upload Image
        </label>
        <CustomDropZone @file-added="handleFileAdded" />
        <!-- Show image if recipe ID is set -->
        <div v-if="props.recipe && props.recipe.id && props.recipe.image_url">
          <img
            :src="props.recipe.image_url"
            alt="Recipe Image"
            class="mt-4 w-[200px] h-[200px] rounded-md shadow-sm"
          />
        </div>
      </div>

      <!-- Submit Button -->
      <Button
        :label="mode + ' Recipe'"
        icon="pi pi-check"
        type="submit"
        class="w-full py-2"
      />
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, watch } from "vue";
import { defineProps } from "vue";

import InputText from "primevue/inputtext";
import Button from "primevue/button";
import Textarea from "primevue/textarea";
import { Ingredient, Recipe } from "../data";
import axios from "axios";
import CustomDropZone from "./CustomDropZone.vue"; // Import your DropZone component

interface FormData {
  name: string;
  cuisine_id: number;
  instructions: string;
  ingredients: Ingredient[];
  image: File | null;
}

// Define props
const props = defineProps<{
  recipe: Recipe | null;
}>();

// Reactive form data
const formData = ref<FormData>({
  name: "",
  cuisine_id: 0,
  instructions: "",
  ingredients: [{ id: null, name: "", quantity: "" }], // Include ID for update
  image: null,
});

// Initialize formData based on props
const initializeFormData = () => {
  formData.value = {
    name: props.recipe?.name || "",
    cuisine_id: props.recipe?.cuisine_id || 0,
    instructions: props.recipe?.instructions || "",
    ingredients: props.recipe?.ingredients?.map((ingredient) => ({
      id: ingredient.id || null, // Ensure ID is set for existing ingredients
      name: ingredient.name || "",
      quantity: ingredient.quantity || "",
    })) || [{ id: null, name: "", quantity: "" }],
    image: null, // Image uploading handled separately
  };
};

// Call the function to initialize formData
initializeFormData();

// Watch for changes in the recipe prop
watch(
  () => props.recipe,
  () => {
    initializeFormData();
  }
);

// Determine mode based on the presence of an ID
const mode = computed(() =>
  props.recipe && props.recipe.id ? "Update" : "Create"
);

// Functions to add/remove ingredients
const addIngredient = () => {
  formData.value.ingredients.push({ id: null, name: "", quantity: "" });
};

const removeIngredient = (index: number) => {
  formData.value.ingredients.splice(index, 1);
};

// Handle file added event
const handleFileAdded = (file: File) => {
  formData.value.image = file;
};

// Submit form data using axios
const submitRecipe = async () => {
  try {
    const data = new FormData();
    data.append("name", formData.value.name);
    data.append("cuisine_id", `${formData.value.cuisine_id}`);
    data.append("instructions", formData.value.instructions);

    formData.value.ingredients.forEach((ingredient, index) => {
      if (ingredient.id) {
        data.append(`ingredients[${index}][id]`, `${ingredient.id}`);
      }
      data.append(`ingredients[${index}][name]`, ingredient.name);
      data.append(`ingredients[${index}][quantity]`, ingredient.quantity);
    });

    // Append image if present
    if (formData.value.image) {
      data.append("image", formData.value.image);
    }

    // Log the FormData entries for debugging
    for (let pair of data.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }

    // Choose method and endpoint based on mode

    const url = `http://localhost:8000/api/recipes${
      mode.value === "Update" ? `/${props.recipe!.id}` : ""
    }`;

    const response = await axios({
      method: "POST",
      url,
      headers: {
        "Content-Type": "multipart/form-data",
        Accept: "application/json",
      },
      data,
    });

    console.log(`${mode.value} recipe successfully:`, response.data);
    alert(`${mode.value} recipe successfully!`);
  } catch (error) {
    console.error(error);
    alert(`Failed to ${mode.value.toLowerCase()} recipe. Please try again.`);
  }
};

// Reset form
const resetForm = () => {
  // Reinitialize formData for a fresh form
  formData.value = {
    name: "",
    cuisine_id: 0,
    instructions: "",
    ingredients: [{ id: null, name: "", quantity: "" }],
    image: null,
  };
};
</script>

<style scoped>
h1 {
  text-align: center;
  margin-bottom: 20px;
}
</style>
