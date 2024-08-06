1. Creating the laravel project
   docker compose exec app composer create-project --prefer-dist laravel/laravel .
2. SSH Into Laravel container
   docker-compose exec -it app sh

php artisan make:migration create_recipes_table
php artisan make:migration create_ingredients_table

php artisan make:model Recipe -m
php artisan make:model Ingredient -m
php artisan make:controller RecipeController --resource
