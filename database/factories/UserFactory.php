<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    static $ids_utilizados = [];
    static $number_of_admins = 0;
    static $number_of_employees = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_specialization = $this->get_user_specialization();

        $availablePeopleIds = $this->get_available_people_ids();

        $id = fake()->randomElement($availablePeopleIds);

        self::$ids_utilizados[] = $id;

        return [
            'people_id' => $id,
            'user_specialization' => $user_specialization,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    private function get_user_specialization()
    {
        $user_specialization = fake()->randomElement(
            User::USER_SPECIALIZATION
        );

        if($user_specialization == 'employees') {
            if(++self::$number_of_employees > 10) {
                $user_specialization = 'admins';
            }
        }

        if($user_specialization == 'admins') {
            if(++self::$number_of_admins > 10) {
                $user_specialization = 'employees';
            }
        }

        return $user_specialization;
    }

    private function get_available_people_ids()
    {
        return Person::whereNotIn(
            'id',
            self::$ids_utilizados
        )->where('person_specialization', 'users')->pluck('id');
    }
}
