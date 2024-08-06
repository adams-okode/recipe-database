<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cuisine;


class CuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cuisines = [
            'French',
            'Italian',
            'Chinese',
            'Indian',
            'Mexican',
            'American',
            'Other'
        ];

        foreach ($cuisines as $cuisine) {
            // Use firstOrCreate to avoid duplicate entries
            Cuisine::firstOrCreate(['name' => $cuisine]);
        }
    }
}
