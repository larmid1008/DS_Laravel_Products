<?php

namespace Database\Seeders;

use Database\Seeders\Seeds\CategorySeeder;
use Database\Seeders\Seeds\ProductSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
