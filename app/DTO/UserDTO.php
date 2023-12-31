<?php

namespace App\DTO;

class UserDTO extends DTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $birthdate,
        public string $user_specialization,
        public int $address_id,
        public int $phone_number_id,
    ) {}
}
