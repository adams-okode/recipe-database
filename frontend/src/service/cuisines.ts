import api from "./api";

export async function listCuisines(page: number = 1) {
  return await api.get(`cuisines?page=${page}`);
}
