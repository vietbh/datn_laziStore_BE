<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            //
            'name' =>fake()->sentence(4,true),
            'brand' =>fake()->sentence(3,true),
            'price' =>fake()->numberBetween(1,65)*1000000,
            'description' =>fake()->paragraph(5,true),
            'image_url'=>fake()->imageUrl(450,450),
            'quantity_in_stock'=>fake()->numberBetween(1,99)

        ];
    }
}
