import api from "./api";

interface ListRecipesOptions {
  page?: number;
  cuisineId?: number | null;
  search?: string | null;
  sortBy?: string | null;
  sortDirection?: "asc" | "desc" | null;
}

export async function listRecipes({
  page = 1,
  cuisineId = null,
  search = null,
  sortBy = null,
  sortDirection = "desc",
}: ListRecipesOptions) {
  try {
    const response = await api.get("recipes", {
      params: {
        page,
        cuisine_id: cuisineId,
        search,
        sort_by: sortBy,
        sort_direction: sortDirection,
      },
    });

    return response;
  } catch (error) {
    console.error("Failed to fetch recipes:", error);
    throw error;
  }
}

export async function getRecipe(id: string) {
  return await api.get(`recipes/${id}`);
}
