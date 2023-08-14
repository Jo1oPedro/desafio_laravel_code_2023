<?php

namespace App\Services;

use App\DTO\PersonDTO;
use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        private PersonService $personService
    ) {}

    public function create(UserDTO $userDTO)
    {
        $personDTO = new PersonDTO(
            $userDTO->name,
            $userDTO->email,
            $userDTO->birthdate,
            'users',
            $userDTO->address_id,
            $userDTO->phone_number_id
        );

        $userDTO->password = Hash::make($userDTO->password);

        $userDTO->people_id = $this->personService
            ->create($personDTO)
            ->id;

        return User::create($userDTO->toArray());
    }
}
