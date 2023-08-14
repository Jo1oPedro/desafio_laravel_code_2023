<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Owner;
use App\Models\Person;
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
        Person::factory(30)->create();
        User::factory(20)->create();
        Employee::factory(10)->create();
        Pet::factory(20)->create();
        Owner::factory(10)->create();
        Admin::factory(10)->create();
        $this->createPetUserRegister();
        $this->createPetOwnerRegister();
        Address::factory(1)->create();
        PhoneNumber::factory(1)->create();

        $person_id = Person::create([
                'name' => 'cascata',
                'email' => 'a@a.com',
                'birthdate' => fake()->date,
                'person_specialization' => 'users',
                'address_id' => Address::latest()->first()->id,
                'phone_number_id' => PhoneNumber::latest()->first()->id
        ])->id;

        $user_id = User::create([
                'people_id' => $person_id,
                'user_specialization' => 'admins',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ])->id;

        Admin::create([
            'user_id' => $user_id
        ]);
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
