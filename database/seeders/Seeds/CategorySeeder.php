<?php

namespace Database\Seeders\Seeds;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::factory()->count(50)->create();
    }
}
