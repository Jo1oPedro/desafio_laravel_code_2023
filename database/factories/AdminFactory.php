<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    static $ids_utilizados = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $availableUserIds = User::whereNotIn(
            'id',
            self::$ids_utilizados
        )->pluck('id');

        $id = fake()->randomElement($availableUserIds);

        self::$ids_utilizados[] = $id;

        return [
            'user_id' => $id
        ];
    }
}
