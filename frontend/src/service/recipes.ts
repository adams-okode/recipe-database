import api from "./api";

export async function listRecipes(page: number = 1) {
  return await api.get(`recipes?page=${page}`);
}

export async function getRecipe(id: string) {
  return await api.get(`recipes/${id}`);
}
