<template>
  <div
    class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-900"
  >
    <slot name="back"></slot>
    <h1 class="text-3xl font-bold text-center mb-8">{{ mode }} Recipe</h1>
    <form @submit.prevent="submitRecipe" class="space-y-6">
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

      <div class="form-field">
        <label for="cuisine" class="block text-sm font-medium text-gray-700">
          Select Cuisine
        </label>
        <Dropdown
          v-model="formData.cuisine_id"
          :options="cuisineOptions"
          optionLabel="name"
          optionValue="id"
          placeholder="Select a Cuisine"
          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          required
        />
      </div>

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

      <div class="form-field">
        <label for="image" class="block text-sm font-medium text-gray-700">
          Upload Image
        </label>
        <CustomDropZone @file-added="handleFileAdded" />
        <div class="flex justify-center">
          <div v-if="props.recipe && props.recipe.id && props.recipe.image_url">
            <img
              :src="props.recipe.image_url"
              alt="Recipe Image"
              class="mt-4 w-[100px] h-[100px] rounded-md shadow-sm"
            />
          </div>
        </div>
      </div>

      <Button
        :label="mode + ' Recipe'"
        icon="pi pi-check"
        type="submit"
        class="w-full py-2"
      />

      <div class="flex justify-center">
        <Button
          v-if="mode === 'Update'"
          label="Delete Recipe"
          icon="pi pi-times"
          class="w-1/2 mx-auto py-2"
          severity="secondary"
          outlined
          @click="deleteRecipe"
        />
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, watch, onMounted } from "vue";
import { defineProps } from "vue";
import { useToast } from "primevue/usetoast";

import InputText from "primevue/inputtext";
import Button from "primevue/button";
import Textarea from "primevue/textarea";
import Dropdown from "primevue/dropdown";
import { Ingredient, Recipe, Cuisine } from "../data";
import axios from "axios";
import CustomDropZone from "./CustomDropZone.vue";
import { listCuisines } from "../service/cuisines";

interface FormData {
  name: string;
  cuisine_id: number;
  instructions: string;
  ingredients: Ingredient[];
  image: File | null;
}

const props = defineProps<{
  recipe: Recipe | null;
}>();

const toast = useToast();

const formData = ref<FormData>({
  name: "",
  cuisine_id: 0,
  instructions: "",
  ingredients: [{ id: null, name: "", quantity: "" }],
  image: null,
});

const cuisineOptions = ref<Cuisine[]>([]);

onMounted(async () => {
  try {
    const { data } = await listCuisines();
    cuisineOptions.value = data;
  } catch (error) {
    console.error("Failed to fetch cuisines:", error);
    toast.add({
      severity: "error",
      summary: "Error",
      detail: "Failed to load cuisines.",
      life: 3000,
    });
  }
});

const initializeFormData = () => {
  formData.value = {
    name: props.recipe?.name || "",
    cuisine_id: props.recipe?.cuisine_id || 0,
    instructions: props.recipe?.instructions || "",
    ingredients: props.recipe?.ingredients?.map((ingredient) => ({
      id: ingredient.id || null,
      name: ingredient.name || "",
      quantity: ingredient.quantity || "",
    })) || [{ id: null, name: "", quantity: "" }],
    image: null,
  };
};

initializeFormData();

watch(
  () => props.recipe,
  () => {
    initializeFormData();
  }
);

const mode = computed(() =>
  props.recipe && props.recipe.id ? "Update" : "Create"
);

const addIngredient = () => {
  formData.value.ingredients.push({ id: null, name: "", quantity: "" });
};

const removeIngredient = (index: number) => {
  formData.value.ingredients.splice(index, 1);
};

const handleFileAdded = (file: File) => {
  formData.value.image = file;
};

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

    if (formData.value.image) {
      data.append("image", formData.value.image);
    }

    const method = mode.value === "Update" ? "PUT" : "POST";
    const url = `http://localhost:8000/api/recipes${
      method === "PUT" ? `/${props.recipe!.id}` : ""
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

    toast.add({
      severity: "success",
      summary: "Success",
      detail: `${mode.value} recipe successfully!`,
      life: 3000,
    });
    resetForm();
  } catch (error: any) {
    if (error.response && error.response.status === 422) {
      console.error("Validation errors:", error.response.data.errors);

      toast.add({
        severity: "contrast",
        summary: "Error!",
        detail: mode.value + " Failed",
        life: 3000,
      });
    } else {
      console.error(error);

      toast.add({
        severity: "contrast",
        summary: "Error",
        detail: `Failed to ${mode.value.toLowerCase()} recipe. Please try again.`,
        life: 3000,
      });
    }
  }
};

const deleteRecipe = async () => {
  if (!props.recipe || !props.recipe.id) {
    return;
  }

  const confirmation = confirm("Are you sure you want to delete this recipe?");
  if (!confirmation) {
    return;
  }

  try {
    const url = `http://localhost:8000/api/recipes/${props.recipe.id}`;
    await axios.delete(url, {
      headers: {
        Accept: "application/json",
      },
    });

    toast.add({
      severity: "success",
      summary: "Success",
      detail: "Recipe deleted successfully!",
      life: 3000,
    });

    resetForm();
  } catch (error) {
    console.error(error);
    toast.add({
      severity: "contrast",
      summary: "Error",
      detail: "Failed to delete the recipe. Please try again.",
      life: 3000,
    });
  }
};

const resetForm = () => {
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
