<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\studentlist>
 */
class StudentlistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'studentno' => fake()->numberBetween(1000000000, 9999999999),
            'name' => fake()->firstNameMale(), 
            'middle' => fake()->lastName(),
            'lastname' => fake()->firstNameMale(), 
            'class' => fake()->lastName(),
            'studimg' => fake()->imageUrl(200, 200), 
        ];
    }
}
