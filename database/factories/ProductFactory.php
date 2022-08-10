<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProductFactory extends Factory
{
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $product->categories()->attach(Category::query()->inRandomOrder()
                ->limit(rand(2, 10))
                ->get()
            );
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $random = fake()->randomFloat(0, 0, 10);
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 0, 215),
            'publish_at' => $random > 5 ? fake()->dateTimeBetween('-1 year') : null,
        ];
    }
}
