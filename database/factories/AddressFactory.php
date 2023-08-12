<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'neighborhood' => 'cascatinha',
            'street' => fake()->streetName,
            'zip_code' => fake()->postcode,
            'number' => fake()->numberBetween(0, 9999)
        ];
    }
}
