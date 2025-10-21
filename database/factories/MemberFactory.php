<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'house_number' => strtoupper($this->faker->bothify('A##')),
            'phone' => $this->faker->phoneNumber(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}