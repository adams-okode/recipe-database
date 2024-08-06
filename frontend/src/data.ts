export interface Recipe {
  id: number;
  name: string;
  cuisine_id: number;
  instructions: string;
  image_path: string;
  image_url?: string;
  created_at: string;
  updated_at: string;
  cuisine: Cuisine;
  ingredients: Ingredient[];
}

export interface Cuisine {
  id: number;
  name: string;
  created_at: string;
  updated_at: string;
}

export interface Ingredient {
  id?: number | null;
  recipe_id?: number;
  name: string;
  quantity: string;
  created_at?: string;
  updated_at?: string;
}

export interface PaginationLink {
  url: string | null;
  label: string;
  active: boolean;
}

export interface RecipesResponse {
  current_page: number;
  data: Recipe[];
  first_page_url: string;
  from: number;
  last_page: number;
  last_page_url: string;
  links: PaginationLink[];
  next_page_url: string | null;
  path: string;
  per_page: number;
  prev_page_url: string | null;
  to: number;
  total: number;
}
