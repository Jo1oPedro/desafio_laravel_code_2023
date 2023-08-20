<?php

namespace Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    CONST ROUTE = 'api/employees';
    //use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::whereEmail('a@a.com')->first();
        $token = $user->createToken('app')->plainTextToken;

        $this->withHeader('Authorization', 'Bearer ' . $token);
    }

    public function test_can_get_employee_successfully(): void
    {
        //act
        $response = $this->json('GET', self::ROUTE);

        //assert
        $response->assertStatus(200);
    }

    public function test_can_create_an_employee_sucessfully(): void
    {
        //prepare
        $response = $this->postJson(self::ROUTE, [
            'name' => 'Cascata',
            'email' => time() . '@gmail.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'birthdate' => '2001-06-26',
            'neighborhood' => 'varinha 1',
            'street' => 'varinha 2',
            'zip_code' => '123456',
            'number' => '1234',
            'country' => '555',
            'ddd' => '55',
            'phone_number' => (string) random_int(10000000, 99999999),
            'work_time' => 'manha'
        ]);

        $response
            ->assertStatus(201);
    }
}
