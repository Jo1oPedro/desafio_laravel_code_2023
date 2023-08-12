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

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'work_time' => $work_time
        ];
    }
}
