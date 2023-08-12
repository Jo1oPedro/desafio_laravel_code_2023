<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\People;
use App\Models\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PeopleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $person_specialization = fake()->randomElement(
            People::PERSON_SPECIALIZATIONS
        );

        return [
            'name' => fake()->name,
            'email' => fake()->unique()->email,
            'birthdate' => fake()->date,
            'person_specialization' => $person_specialization,
            'address_id' => Address::inRandomOrder()->first()->id,
            'phone_number_id' => PhoneNumber::inRandomOrder()->first()->id
        ];
    }
}
