<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $q = random_int(1,10);
        return [
            'title' => $this->faker->sentence(),
            'author' => $this->faker->name(),
            'cover_image' => 'https://picsum.photos/200/300',
            'isbn' => $this->faker->bothify('##########'),
            'description' => $this->faker->paragraph(),
            'category_id' => $this->faker->numberBetween(1, 2),
            'quantity' => $q,
            'available_quantity' => $q,
            'status' => 'available',
        ];
    }
}
