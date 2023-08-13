<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Person;
use App\Models\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PersonFactory extends Factory
{
    private static $number_of_users = 0;
    private static $number_of_owners = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $person_specialization = $this->get_person_specialization();

        return [
            'name' => fake()->name,
            'email' => fake()->unique()->email,
            'birthdate' => fake()->date,
            'person_specialization' => $person_specialization,
            'address_id' => Address::inRandomOrder()->first()->id,
            'phone_number_id' => PhoneNumber::inRandomOrder()->first()->id
        ];
    }

    private function get_person_specialization()
    {
        $person_specialization = fake()->randomElement(
            Person::PERSON_SPECIALIZATIONS
        );

        if($person_specialization == 'users') {
            if(++self::$number_of_users > 20) {
                $person_specialization = 'owners';
            }
        }

        if($person_specialization == 'owners') {
            if(++self::$number_of_owners > 10) {
                $person_specialization = 'users';
            }
        }

        return $person_specialization;
    }
}
