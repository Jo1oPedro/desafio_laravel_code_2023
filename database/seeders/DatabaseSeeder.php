<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Employee;
use App\Models\Owner;
use App\Models\People;
use App\Models\Pet;
use App\Models\PhoneNumber;
use App\Models\User;
use Database\Factories\PetUserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Address::factory(20)->create();
        PhoneNumber::factory(20)->create();
        People::factory(20)->create();
        User::factory(20)->create();
        Employee::factory(20)->create();
        Pet::factory(20)->create();
        Owner::factory(20)->create();
        $this->createPetUserRegister();
        $this->createPetOwnerRegister();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

    private function createPetUserRegister()
    {
        $pet = Pet::inRandomOrder()->first();
        Employee::inRandomOrder()
            ->first()
            ->pets()
            ->attach($pet, [
                'value' => fake()->randomFloat(2, max: 5000),
                'work_done' => fake()->text(10),
                'finished_at' => fake()->dateTime('+1 month')
            ]);
    }

    private function createPetOwnerRegister()
    {
        $pet = Pet::InRandomOrder()->first();
        Owner::inRandomOrder()
            ->first()
            ->pets()
            ->attach($pet, [
               'finished_at' => fake()->dateTime('+1 month')
            ]);
    }
}
