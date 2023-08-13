<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Employee;
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
        $availableUserIds = $this->get_available_user_ids();

        $id = fake()->randomElement($availableUserIds);

        self::$ids_utilizados[] = $id;

        return [
            'user_id' => $id
        ];
    }

    private function get_available_user_ids()
    {
        return User::whereNotIn(
            'id',
            array_merge(self::$ids_utilizados, Employee::pluck('user_id')->toArray())
        )->pluck('id');
    }
}
