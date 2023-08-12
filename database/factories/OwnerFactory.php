<?php

namespace Database\Factories;

use App\Models\Owner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\People;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Owner>
 */
class OwnerFactory extends Factory
{
    static $ids_utilizados = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $availablePeopleIds = People::whereNotIn(
            'id',
            array_merge(self::$ids_utilizados, User::pluck('people_id')->toArray())
        )->pluck('id');

        $id = fake()->randomElement($availablePeopleIds);

        self::$ids_utilizados[] = $id;

        return [
            'people_id' => $id
        ];
    }
}
