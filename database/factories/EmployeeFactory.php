<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    static $ids_utilizados = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $work_time = fake()->randomElement(
            Employee::WORK_TIMES
        );

        $availableUserIds = User::whereNotIn(
            'id',
            self::$ids_utilizados
        )->pluck('id');

        $id = fake()->randomElement($availableUserIds);

        self::$ids_utilizados[] = $id;

        return [
            'user_id' => $id,
            'work_time' => $work_time
        ];
    }
}
