<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'shortDescription' => Str::random(50),
            'Description' => Str::random(100),
            'price' => '999',
            'stock' => '50',
            'category_id' => '1',
            'sub_category_id' => '24',
            'brand_id' => '3',
            'user_id' => '3',
            'user_ip' => '127.0.0.1',
        ];
    }
}
